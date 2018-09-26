<?php
/**
 * Created by PhpStorm.
 * User: Velmont
 * Date: 2018-09-02
 * Time: 오후 9:16
 */

namespace App\Http\Controllers;


use App\Services\TrelloApiService;
use Illuminate\Http\Request;

class TrelloController extends Controller
{
    const KEY = 'e18ab2b214b405f46f7f488a57eea6d8';
    const TOKEN = 'b40ee1cc127a10044c1888d65b42cd5afe8bcf49fcd6a2fa9f3e4624fc382b7d';
    const ID_VELMONT = "554f251ab2a66a62870dcee6";
    const BOARD_ID = 'lzHhox3G';

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBoardCard()
    {
        $trelloApiService = new TrelloApiService();
        return $this->toJson($trelloApiService->init(self::KEY, self::TOKEN)->boardCards(self::BOARD_ID)->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBoardCardFilteredByIds(Request $request)
    {
        // 멤버 이름별 컨텐츠로 분리
        $memberNames = $request->input('memberNames');
        $memberNamesFilter = array(
            'username' => $memberNames
        );

        // 각각의 컨텐츠에 커스텀 필터 정보를 주입
        /** @var array $customFieldIds */
        // $customFieldIds = ['Start Date', 'Status', 'Task', 'Part'];

        $trelloApiService = new TrelloApiService();
        $memberInfos = $this->getMemberInfos($memberNamesFilter);

        // 멤버 tid 정보 얻어오기
        $memberIds = [];
        foreach ($memberInfos as $memberInfo) {
            $memberIds[$memberInfo['username']] = $memberInfo['id'];
        }

        // id 필터 생성
        $idFilter = array(
            "idMembers" => $memberIds,
        );

        $visibility = 'all';

        $customFieldsInfos = $this->getCustomFieldInfos();

        $cardsByIds = $trelloApiService
            ->init(self::KEY, self::TOKEN)
            ->boardCards(self::BOARD_ID)
            ->filter(['dueComplete' => false])
            ->notEmptyFilter(['due'])
            ->customFields($customFieldsInfos)
            ->filter($idFilter, true)
            ->get();

        //change memberId key to memberName key
        foreach ($memberIds as $key => $value) {
            $cardsByIds[$key] = $cardsByIds[$value];
            unset($cardsByIds[$value]);
        }
        return $this->toJson($cardsByIds);
    }

    private function getCustomFieldInfos(): array
    {
        $trelloApiService = new TrelloApiService();

        $customFieldInfos = $trelloApiService->init(self::KEY, self::TOKEN)->boardCustomFields(self::BOARD_ID)->get();
        return $customFieldInfos;
    }

    /**
     * @param string $customFieldName
     * @return string
     */
    public function getCustomFieldIdByName(string $customFieldName = ''): string
    {
        $trelloApiService = new TrelloApiService();

        $customFieldInfo = $trelloApiService
            ->init(self::KEY, self::TOKEN)
            ->boardCustomFields(self::BOARD_ID)
            ->filter(array('name' => $customFieldName))
            ->getFirst();

        return $customFieldInfo['id'];
    }

    /**
     * @param array $customFieldNames
     * @return array
     */
    public function getCustomFieldIds(array $customFieldNames): array
    {
        $trelloApiService = new TrelloApiService();

        $customFieldInfo = $trelloApiService
            ->init(self::KEY, self::TOKEN)
            ->boardCustomFields(self::BOARD_ID)
            ->filter(array('name' => $customFieldNames))
            ->get();

        $ids = [];
        foreach ($customFieldInfo as $customField) {
            $ids[] = $customField['id'];
        }
        return $ids;
    }

    public function getBoardLists(): array
    {
        $boardLists = $this->trelloInit()->boardLists(self::BOARD_ID)->get();
        return $boardLists;
    }

    /**
     * @param string $memberName
     * @return string
     */
    public function getMemberId(string $memberName): string
    {
        $trelloApiService = new TrelloApiService();
        $memberInfo = $this->trelloInit()->boardMember(self::BOARD_ID, $memberName)->getFirst();
        return $memberInfo['id'];
    }

    public function getMemberInfos(array $memberNamesFilter = []): array
    {
        $trelloApiService = new TrelloApiService();
        $memberInfo = $trelloApiService->init(self::KEY, self::TOKEN)->boardMembers(self::BOARD_ID, $memberNamesFilter)->get();
        return $memberInfo;
    }

    private function trelloInit(): TrelloApiService
    {
        $trelloApiService = new TrelloApiService();
        return $trelloApiService->init(self::KEY, self::TOKEN);
    }
}