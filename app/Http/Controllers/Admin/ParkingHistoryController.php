<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ParkingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $parkingHistory = ParkingHistory::with('parking_location');
            return DataTables::of($parkingHistory)
            ->addIndexColumn()
            ->addColumn('amount', function($query){
                return 'Rp. ' . number_format($query->amount, 0, ",", ".");
            })
            ->addColumn('action', function($eachRow){
                return $this->getActionColumn($eachRow);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('parkingHistories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingHistory $parkingHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingHistory $parkingHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingHistory $parkingHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingHistory $parkingHistory)
    {
        //
    }

    public function getActionColumn($data)
    {
        // $editBtn = route('histories.edit', $data->id);
        // $deleteBtn = route('histories.destroy', $data->id);
        // $ident = Str::random(10);
        // return
        // '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
        // . '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        // <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        // <input type="hidden" name="_token" value="'.csrf_token().'" />
        // <input type="hidden" name="_method" value="DELETE">
        // </form>';
    }

    public function ExportExcel($customer_data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Customer_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public function all()
    {
        $dataParking = ParkingHistory::with('parking_location')->get();

        $dataLabel = [[
            'parking_location',
            'code',
            'vehicle',
            'amount',
            'check_in',
            'check_out',
            'payment_status',
            'payment_type'
        ]
        ];

        $dataWrite = $dataParking->map(function($query){
            return [
                'parking_location' => $query->parking_location->name,
                'code' => $query->code,
                'vehicle' => $query->vehicle,
                'amount' => $query->amount,
                'check_in' => Carbon::parse($query->check_in)->format('d F Y H:i:s'),
                'check_out' => Carbon::parse($query->check_out)->format('d F Y H:i:s'),
                'payment_status' => $query->payment_status,
                'payment_type' => $query->payment_type
            ];
        });
        $readyToSave = array_merge($dataLabel,$dataWrite->toArray());
        $this->ExportExcel($readyToSave);
    }
}
