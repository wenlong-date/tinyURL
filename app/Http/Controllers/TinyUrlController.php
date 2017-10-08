<?php
/**
 * @author wenlong.
 * @createOn 2017/10/7 0007 18:39
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TinyUrlController extends Controller
{
    private $tinyUrl = '';
    const SIXTWO = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    // init the CONFIG TINY_URL
    public function __construct()
    {
        if (env('TINY_URL')) {
            $this->tinyUrl = env('TINY_URL');
        }
    }

    /**
     * 对POST的短链接地址进行查询
     * @param Request $request
     * @param string $decodeUrl
     * @return mixed
     */
    public function decodeUrl(Request $request, $decodeUrl = '')
    {
        $info['state'] = false;
        do {
            $id = $this->decode($decodeUrl);
            if ($id === '') {
                $info['error'] = 'can not find the URL';
                break;
            }
            $result = DB::table('urls')->where('id', $id)->first();
            if ($result && $result->url) {
                // redirect the url
                return redirect($result->url, 302);
                break;
            } else {
                $info['error'] = 'can not find the URL';
            }
        } while (0);

        return $info;
    }

    /**
     * 对长连接进行保存生成短链接
     * @param Request $request
     * @param string $encodeUrl
     * @return mixed
     */
    public function encodeUrl(Request $request)
    {
        $encodeUrl = $request->post('url', '');
        $info['state'] = false;
        do {
            if ($encodeUrl === '') {
                $info['error'] = "Url can't be empty!";
                break;
            }

            $result = DB::table("urls")->insertGetId([
                'url' => $encodeUrl,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            //encodeID trans to code
            $shortUrl = $this->encode($result);
            // TODO save to redis

            $info['data'] = $this->tinyUrl . $shortUrl;
            $info['state'] = true;

        } while (0);

        return $info;
    }

    /**
     * 10进制转62进制
     * @param int $id
     * @return array|string
     */
    private function encode($id = 0)
    {
        $result = [];
        while ($id != 0) {
            array_unshift($result, substr(self::SIXTWO, $id%62, 1));
            $id = intval($id / 62);
        }
        $result = implode('', $result);
        if(strlen($result) < 6) {
            $result = str_pad($result, 6, '0', STR_PAD_LEFT);
        }
        return $result;
    }

    /**
     * 62进制转10进制
     * @param string $shortUrl
     * @return int
     */
    private function decode($shortUrl = '')
    {
        // TODO find from redis firstly
        $transToTen = 0;
        for ($i =0,$j=strlen($shortUrl); $i < $j; $i++){
            $transToTen = $transToTen * 62 + strpos(self::SIXTWO, substr($shortUrl, $i, 1));
        }

        return $transToTen;
    }
}