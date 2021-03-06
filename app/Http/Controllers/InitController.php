<?php

namespace App\Http\Controllers;

use App\Helpers\Tool;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * 初始化安装操作
 * Class InitController
 * @package App\Http\Controllers
 */
class InitController extends Controller
{
    /**
     * 首次安装
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function _1stInstall(Request $request)
    {
        // 检测是否已经配置client_id等信息
        $client_id = Tool::config('client_id');
        $client_secret = Tool::config('client_secret');
        $redirect_uri = Tool::config('redirect_uri');
        if ($client_id != '' && $client_secret != '' && $redirect_uri != '') return redirect()->route('list');
        //  显示基础信息的填写、申请或提交应用信息、返回
        if ($request->isMethod('get')) return view('install.init');
        $client_id = $request->get('client_id');
        $client_secret = $request->get('client_secret');
        $redirect_uri = $request->get('redirect_uri');
        if ($client_id == '' || $client_secret == '' || $redirect_uri == '') {
            Tool::showMessage('参数请填写完整', false);
            return redirect()->back();
        }
        // 写入数据库
        $data = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri
        ];
        Cache::forget('config');
        $editData = [];
        foreach ($data as $k => $v) {
            $editData[] = [
                'name' => $k,
                'value' => $v
            ];
        }
        $update = new Parameter();
        $update->updateBatch($editData);
        return redirect()->route('list');
    }

    /**
     * 申请相关密钥
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request)
    {
        // 感谢donwa提供的方法
        $redirect_uri = $request->get('redirect_uri');
        $ru = "https://developer.microsoft.com/en-us/graph/quick-start?appID=_appId_&appName=_appName_&redirectUrl={$redirect_uri}&platform=option-php";
        $deepLink = "/quickstart/graphIO?publicClientSupport=false&appName=OLAINDEX&redirectUrl={$redirect_uri}&allowImplicitFlow=false&ru=" . urlencode($ru);
        $app_url = "https://apps.dev.microsoft.com/?deepLink=" . urlencode($deepLink);
        return redirect()->away($app_url);
    }

}
