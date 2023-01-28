<?php

namespace App\AppActions;

use App\Interfaces\AppActionInterface;

/**
 * AppAction Interface 구현 클래스를 groupName, actionName 으로 생성해서 가져온다.
 *
 */
class AppActionFactory
{
    /**
     * @param string $groupName AppActions 밑의 하위 디렉토리명. namespace 때문에 필요. App\AppActions 밑에 바로 action 이 있으면 빈 문자열을 넣는다.
     * @param string $actionName Action Name
     * @param array $data action 초기화에 필요한 파라메터
     * @return AppActionInterface
     * 내부에서 App\AppActions\groupName\actionName 이름의 클래스를 생성한다.
     * groupName 이 필요한 이유는 namespace 를 사용하지 않아도 클래스를 정확히 지정할 수 있기 때문이다.
     */
    public static function getAction(string $groupName, string $actionName, array $data) : AppActionInterface
    {
        $groupName = blank($groupName) ? "" : "\\" . $groupName;
        $fullName = "App\\AppActions" . $groupName . "\\" . $actionName;
        return new $fullName($data);
    }
}
