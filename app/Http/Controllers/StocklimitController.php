<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events\OpLog;
use App\StockLimits;
use Redirect;
use Gate;


class StockLimitController extends Controller
{
    /**
     * construct
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index
     *
     * @return Response
     */
    public function index(Request $request)
    {
        event(new OpLog());
        if (Gate::denies('enter', new StockLimits())) {
            abort(403);
        }

        $filter_id = $request->input('filter_id');
        $filter_stock_code = $request->input('filter_stock_code');

        $query = $request->input();
        $page = empty($query['page']) ? 1 : max(1, intval($query['page']));
        unset($query['page']);
        $stocklimit_query = Stocklimits::query();
        if ($filter_id){
            $stocklimit_query->where('id', '=', $filter_id);
        }
        if ($filter_stock_code){
            $stocklimit_query->where('ticker', '=', $filter_stock_code);
        }

        $stocklimit_lists = $stocklimit_query->paginate()->appends($query);

        $view_data = [
            'stocklimit_lists' => $stocklimit_lists,
            'page' => $page,
            'query' => $query
        ];

        return view('stocklimit.list', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        event(new OpLog());

        return view('stocklimit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $exch_id = $request->input('exch_id');

        $buy_qty_lower_limit = $request->input('buy_qty_lower_limit');
        $sell_qty_lower_limit = $request->input('sell_qty_lower_limit');

        $this->validate($request, [
            'exch_id' => 'required|integer|in:1,2',
            'ticker' => 'required|unique:xtp_exch_sec_limits,ticker,NULL,id,exch_id,'.$exch_id.'|regex:/^\d{6}$/',
            'buy_qty_lower_limit' => 'required|integer',
            'buy_qty_upper_limit' => 'required|integer|min:'.$buy_qty_lower_limit,
            'sell_qty_lower_limit' => 'required|integer',
            'sell_qty_upper_limit' => 'required|integer|min:'.$sell_qty_lower_limit,
            'start_day' => 'required|date',
            'end_day' => 'required|date|after:start_day',

        ]);

        $stocklimit = new StockLimits();
        $stocklimit->exch_id = $request->input('exch_id');
        $stocklimit->ticker = $request->input('ticker');
        $stocklimit->buy_qty_lower_limit = $request->input('buy_qty_lower_limit');
        $stocklimit->buy_qty_upper_limit = $request->input('buy_qty_upper_limit');
        $stocklimit->sell_qty_lower_limit = $request->input('sell_qty_lower_limit');
        $stocklimit->sell_qty_upper_limit = $request->input('sell_qty_upper_limit');
        $stocklimit->start_day = $request->input('start_day');
        $stocklimit->end_day = $request->input('end_day');

        $ret = $stocklimit->save();
        event(new OpLog($stocklimit));

        if ($ret) {
            return Redirect::to('stocklimit/'.$stocklimit->id);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        event(new OpLog($id));

        $stocklimit = StockLimits::find($id);

        return view('stocklimit.edit', ['stocklimit'=>$stocklimit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $stocklimit = Stocklimits::findOrFail($id);

        $exch_id = $request->input('exch_id');
        $buy_qty_lower_limit = $request->input('buy_qty_lower_limit');
        $sell_qty_lower_limit = $request->input('sell_qty_lower_limit');


        $this->validate($request, [
            'exch_id' => 'required|integer|in:1,2',
            'ticker' => 'required|unique:xtp_exch_sec_limits,ticker,'.$id.',id,exch_id,'.$exch_id.'|regex:/^\d{6}$/',
            'buy_qty_lower_limit' => 'required|integer',
            'buy_qty_upper_limit' => 'required|integer|min:'.$buy_qty_lower_limit,
            'sell_qty_lower_limit' => 'required|integer',
            'sell_qty_upper_limit' => 'required|integer|min:'.$sell_qty_lower_limit,
            'start_day' => 'required|date',
            'end_day' => 'required|date|after:start_day',
        ]);

        $stocklimit->exch_id = $request->input('exch_id');
        $stocklimit->ticker = $request->input('ticker');
        $stocklimit->buy_qty_lower_limit = $request->input('buy_qty_lower_limit');
        $stocklimit->buy_qty_upper_limit = $request->input('buy_qty_upper_limit');
        $stocklimit->sell_qty_lower_limit = $request->input('sell_qty_lower_limit');
        $stocklimit->sell_qty_upper_limit = $request->input('sell_qty_upper_limit');
        $stocklimit->start_day = $request->input('start_day');
        $stocklimit->end_day = $request->input('end_day');


        event(new OpLog($stocklimit));

        if ($stocklimit->saveOrFail()) {
            return Redirect::to('stocklimit/'.$id);
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        event(new OpLog($id));

        $ret = [
            'error_code' => 0,
            'error_message' => ''
        ];
        $stocklimit = StockLimits::find($id);
        if (!$stocklimit){
            $ret['error_code'] = -1;
            $ret['error_message'] = '不存在';
        } else {
            if (!$stocklimit->destroy($id) ){
                $ret['error_code'] = 1;
                $ret['error_message'] = '保存失败';
            }
        }

        echo json_encode($ret);
    }

    /**
     * Show the page for display resource.
     *
     * @return Response
     */
    public function show($id)
    {
        event(new OpLog($id));

        $stocklimit = StockLimits::findOrFail($id);

        return view('stocklimit.show', ['stocklimit'=>$stocklimit]);
    }
}
