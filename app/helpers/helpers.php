<?php

namespace App\Helpers;

use Auth;

class Helpers {
    public static function designation($market, $opts=[]) {

        if (!is_array($opts)){
            $opts = [$opts];
        }

        if ($market=='sh' || $market=='sz') {
            $config = config("designation.".$market);
            $opts[] = $config['ip'];
            $opts[] = $config['port'];
        }

        $params = join(' ', $opts);
        $result = [];

//        ////////////    临时处理开始
//        $log = new \App\DesignationLog();
//        $log->username = Auth::user()['username'];
//        $log->market = $market;
//        $log->params = $params;
//        $log->result = 'mock';
//        $log->save();
//        return ['status'=>0];
//        ////////////   临时处理结束

        $bin = config('designation.bin');
        $bin .= ' ' . $market . ' ' . $params;

        if (!file_exists($bin)){
            return null;
        }

        exec($bin, $result) ;
//        $result = ['{"status":0,"xtp_id":209933707161634,"cl_order_id":"C4002wDa","exch_order_id":"000000BFDEADBEF1","transferee_pbuid":"007710","pbu_id":"016701","account_id":"0123456789","branch_id":"C4","error_code":0,"message":"0","confirm_time":20160901112730507}'];

        $log = new \App\DesignationLog();
        $log->username = Auth::user()['username'];
        $log->market = $market;
        $log->params = $params;
        $log->result = join('\n', $result);
        $log->save();

        if(count($result) == 0){
            return null;
        }

        $result = json_decode(array_pop($result), true);

        return $result;

    }

    public static function BSFlagStr($BSFlag){
        static $bs = [
            1 => '正常业务买委托',
            2 => '正常业务卖委托',
            3 => '正常业务撤销委托',
            4 => '即时成交撤剩余买',
            5 => '即时成交撤剩余卖',
            6 => '转托管申请',
            7 => '撤销转托管',
            8 => '配股认购',
            9 => '配股撤单',
            10 => '可转债转股委托',
            11 => '可转债撤销转股',
            12 => '可转债回售委托',
            13 => '可转债回售撤销',
            14 => '新股申购委托',
            15 => '新股申购撤销',
            16 => '新股申购中签后放弃认购',
            17 => '新股申购中签后取消放弃认购',
            18 => '无冻结股份质押质权人申报记录',
            19 => '无冻结股份质押出质人申报记录',
            20 => '无冻结股份质押中撤单委托',
            21 => '冻结股份质押质权人申报记录',
            22 => '冻结股份质押出质人申报记录',
            23 => '冻结股份质押中撤单委托',
            24 => '无冻结股份解冻质权人申报记录',
            25 => '无冻结股份解冻出质人申报记录',
            26 => '无冻结股份解冻撤单委托',
            27 => '冻结股份解冻质权人申报记录',
            28 => '冻结股份解冻出质人申报记录',
            29 => '冻结股份解冻撤单委托',
            30 => '流通股份要约收购预要约申报',
            31 => '流通股份要约收购预要约撤单',
            32 => '流通股份要约收购解除预要约申报',
            33 => '流通股份要约收购解除预要约撤单',
            34 => '开放式基金申购委托',
            35 => '开放式基金赎回委托',
            36 => '开放式基金申购赎回取消',
            37 => '权证行权申报',
            38 => '权证行权取消',
            39 => 'ETF申购申报',
            40 => 'ETF赎回申报',
            41 => '最优档成交剩余撤销买委托记录',
            42 => '最优档成交剩余撤销卖委托记录',
            43 => '全额成交或撤单买委托记录',
            44 => '全额成交或撤单卖委托记录',
            45 => '本方最优价格买委托',
            46 => '本方最优价格卖委托',
            47 => '本方最优价格撤单委托',
            48 => '对手最优价格买委托',
            49 => '对手最优价格卖委托',
            50 => '对手最优价格撤单委托',
            51 => '最优五档即时成交转限价买',
            52 => '最优五档即时成交转限价卖',
            53 => '质押回购买入融资',
            54 => '质押回购卖出融券',
            55 => '质押回购买入融资撤单',
            56 => '质押回购卖出融券撤单',
            57 => '开放式基金认购',
            58 => '开放式基金认购撤单',
            59 => '开放式基金转托管',
            60 => '开放式基金转托管撤单',
            61 => '开放式基金设置分红方式',
            62 => '开放式基金设置分红方式撤单',
            63 => '开放式基金转换',
            64 => '开放式基金转换撤单',
            65 => 'ETF认购',
            66 => 'ETF认购撤单',
            67 => '指定交易登记',
            68 => '指定交易注销',
            69 => '回购注销',
            70 => '网络密码激活',
            71 => '网络密码注销',
            72 => '网络投票',
            73 => '跨市场ETF申购',
            74 => '跨市场ETF赎回 ',
            75 => '跨境ETF申购',
            76 => '跨境ETF赎回 ',
            77 => '债券ETF申购',
            78 => '债券ETF赎回 ',
            79 => '上证交易型货币基金申购',
            80 => '上证交易型货币基金赎回',
            81 => '深证货币ETF申购',
            82 => '深证货币ETF赎回',
            83 => '黄金ETF申购',
            84 => '黄金ETF赎回',
            85 => '黄金现货合约ETF申购',
            86 => '黄金现货合约ETF赎回',
            87 => '跨市场ETF冲账',
            88 => '上证实时申赎货币基金申购',
            89 => '上证实时申赎货币基金赎回',
            90 => '基金合并',
            91 => '基金拆分',
            92 => '基金合并分拆撤单',
            93 => '个股期权FOK限价买',
            94 => '个股期权FOK限价卖',
            95 => '个股期权FOK市价买',
            96 => '个股期权FOK市价卖',
            97 => '个股期权证券锁定',
            98 => '个股期权证券解锁',
            99 => '个股期权行权',
            100 => '个股期权撤销行权',
            101 => '港股通竞价限价买',
            102 => '港股通竞价限价卖',
            103 => '港股通增强限价买',
            104 => '港股通增强限价卖',
            105 => '港股通零股限价卖',
        ];

        if (!empty($bs[$BSFlag])){
            return $bs[$BSFlag] . " [$BSFlag]";
        }
        return '[$BSFlag]';
    }

    public static function OrderStatusStr($OrderStatus){
        $os = [
            '1' => '正报',
            '2' => '已报',
            '3' => '已报待撤',
            '4' => '部成待撤',
            '5' => '部成部撤',
            '6' => '已撤',
            '7' => '部成',
            '8' => '已成',
            '9' => '废单',
            'A' => '未报',
        ];

        if (isset($os[$OrderStatus])){
            return $os[$OrderStatus] . " [$OrderStatus]";
        }
        return '[$OrderStatus]';
    }

    public static function controllerStr($controller_name) {
        $controller_map = [
            'Default' => '首页',
            'Home' => '首页',
            'Auth' => '登录',
            'Account' => '个人资料',
            'User' => '客户管理',
            'Record' => '委托记录',
            'Server' => '服务器管理',
            'Org' => '客户管理',
            'Branche' => '合同号管理',
            'OmsConfig' => '交易节点信息配置',
            'OgwConfig' => '报盘节点信息配置',
            'OgwBranche' => '上交所报盘节点',
            'StockLimit' => '股票限制管理',
            'TradeWay' => '委托方式管理',
            'TradeWayType' => '委托方式类型管理',
            'WhiteList' => '预开户管理',
            'UserTradeWay' => '用户委托方式',
            'Permission'  => '权限列表',
            'Authorize'  => '授权管理',
        ];

        if (isset($controller_map[$controller_name])){
            return $controller_map[$controller_name];
        }
        return $controller_name;

    }

    public static function actionTypesStr($action_type) {
        $action_types_map = [
            'index' => '显示列表页',
            'show' => '显示详情页',
            'create' => '显示新建页',
            'store' => '保存新建项',
            'edit' => '显示修改页',
            'update' => '保存修改项',
            'destroy' => '删除项',
            'getDestroy' => "销户",
            'check' => "销户确认",
            'getLogin' => '登录',
            'getLogout' => '退出'
        ];

        if (isset($action_types_map[$action_type])){
            return $action_types_map[$action_type];
        }
        return $action_type;

    }
}