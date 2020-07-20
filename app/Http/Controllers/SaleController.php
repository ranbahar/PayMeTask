<?php

namespace App\Http\Controllers;

use App\Sale;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all()->sortByDesc('time');

        return view('welcome', compact(['sales']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info("create");
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isSave = $request['button'] === 'Save';
        Log::info("store method");
        $response = $this->getPayMeData($request);;

        if (!$isSave) {
            Log::info("get Data from PayMe service");
            Log::info($response);
            if ($response['status_code'] == 0)
                $request->request->add(['payment_Link' => $response['sale_url']]);
        } else {
            Log::info("store in DB");

            $request->request->add(['payment_Link' => $response['sale_url'], 'sale_number' => $response['payme_sale_code'],
                'time' => Carbon::now(new DateTimeZone('Asia/Jerusalem'))]);

            Sale::create($request->all());
        }

        Log::info($request);

        Log::info($response);

        return $isSave ? redirect('/sales') : view('create', compact('request', 'response'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getPayMeData(Request $request)
    {
        Log::info('getPayMeData');
        $amount = ((float)$request['amount']) * 100;
        $response = Http::post('https://preprod.paymeservice.com/api/generate-sale', [
            'seller_payme_id' => 'MPL14985-68544Z1G-SPV5WK2K-0WJWHC7N',
            'sale_price' => $amount,
            'currency' => $request['currency'],
            'product_name' => $request['description'],
            'installments' => '1',
            'language' => 'en'
        ]);

        Log::info($response);

        return $response;
    }
}
