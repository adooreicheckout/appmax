<?php

namespace Hdelima\AppMax\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hdelima\AppMax\Models\AppMaxNotification;

class AppMaxNotificationController extends Controller
{
    /**
     * Index a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = AppMaxNotification::query();

		$query->when( $request->page, function( $query ) use ( $request ) {
			$offSet = ( $request->page * ( $request->limit ?: config('appmax.limit_per_page', 15 ) ) ) - ( $request->limit ?: config('appmax.limit_per_page', 15 ) );
			return $query->offSet($offSet);
		});

		$query->orderBy('id', 'desc');

		$data = $query->limit( $request->limit ?: config('appmax.limit_per_page', 15) )->get();

		return response()->json( $data );
    }

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
			'environment' 	=> 'required',
			'event'			=> 'required',
			'data'			=> 'required'
		]);

		$payload = json_decode( $request->data, true );

		$request->merge(['status' => $payload['status'] ?: 'NOT_FOUND']);

		AppMaxNotification::create( $request->only([
			'environment',
			'event',
			'data',
			'status'
		]));

		return response()->json( null, 204 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AppMaxNotification::findOrFail( $id );

		return response()->json( $data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->validate( $request, [
			'environment' 	=> 'nullable',
			'event'			=> 'nullable',
			'data'			=> 'nullable',
			'status'		=> 'nullable',
		]);

		AppMaxNotification::findOrFail( $id )->update(array_filter($request->only([
			'environment',
			'event',
			'data',
			'status',
		])));

		return response()->json( null, 204 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AppMaxNotification::destroy( $id );
		return response()->json( null, 204 );
    }
}
