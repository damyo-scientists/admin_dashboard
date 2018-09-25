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
        $memberNames = $request->input('memberNames');
        $memberNamesFilter = array(
            'username' => $memberNames
        );
        /** @var array $customFieldIds */
        $customFieldIds = $request->get('customFieldIds');
        $customFieldIds = ['5b9100c31ff50a5026ca4e51'];

        $trelloApiService = new TrelloApiService();
        $memberInfos = $this->getMemberInfos($memberNamesFilter);
        $memberIds = [];
        foreach ($memberInfos as $memberInfo) {
            $memberIds[$memberInfo['username']] = $memberInfo['id'];
        }
        $idFilter = array(
            "idMembers" => $memberIds,
        );
        $visibility = 'all';
        $customFieldsFilter = array(
            array(
                'ids' => $customFieldIds,
                'name' => 'start',
                'type' => 'date'
            )
        );
        $cardsByIds = $trelloApiService
            ->init(self::KEY, self::TOKEN)
            ->boardCards(self::BOARD_ID)
            ->filter(['dueComplete' => false])
            ->notEmptyFilter(['due'])
            ->customFields($customFieldsFilter)
            ->filter($idFilter, true)
            ->get();

        //change memberId key to memberName key
        foreach ($memberIds as $key => $value) {
            $cardsByIds[$key] = $cardsByIds[$value];
            unset($cardsByIds[$value]);
        }
        return $this->toJson($cardsByIds);
    }

    /**
     * @param string $customFieldName
     * @return string
     */
    public function getCustomFieldId(string $customFieldName = ''): string
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
     * @param string $memberName
     * @return string
     */
    public function getMemberId(string $memberName): string
    {
        $trelloApiService = new TrelloApiService();
        $memberInfo = $trelloApiService->init(self::KEY, self::TOKEN)->boardMember(self::BOARD_ID, $memberName)->getFirst();
        return $memberInfo['id'];
    }

    public function getMemberInfos(array $memberNamesFilter = []): array
    {
        $trelloApiService = new TrelloApiService();
        $memberInfo = $trelloApiService->init(self::KEY, self::TOKEN)->boardMembers(self::BOARD_ID, $memberNamesFilter)->get();
        return $memberInfo;
    }
}