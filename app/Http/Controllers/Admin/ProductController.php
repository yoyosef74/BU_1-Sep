<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Apptitle;
use App\Models\Footertext;
use App\Models\Seosetting;
use App\Models\Pages;
use App\Models\Product;
use Auth;
use Str;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = Product::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<div class = "d-flex">';
                    if (Auth::user()->can('Project Edit')) {

                        $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="action-btns1 edit-testimonial"><i class="feather feather-edit text-primary" data-id="' . $data->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>';
                    } else {
                        $button .= '~';
                    }
                    if (Auth::user()->can('Project Delete')) {
                        $button .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="action-btns1" id="delete-testimonial" ><i class="feather feather-trash-2 text-danger" data-id="' . $data->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a>';
                    } else {
                        $button .= '~';
                    }

                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('checkbox', function ($data) {
                    if (Auth::user()->can('Project Delete')) {
                        return '<input type="checkbox" name="project_checkbox[]" class="checkall" value="' . $data->id . '" />';
                    } else {
                        return '<input type="checkbox" name="project_checkbox[]" class="checkall" value="' . $data->id . '" disabled />';
                    }
                })
                ->addColumn('name', function ($data) {
                    return Str::limit($data->name, '40');
                })
                ->rawColumns(['action', 'checkbox', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        $basic = Apptitle::first();

        $title = Apptitle::first();
        $data['title'] = $title;

        $footertext = Footertext::first();
        $data['footertext'] = $footertext;

        $seopage = Seosetting::first();
        $data['seopage'] = $seopage;

        $post = Pages::all();
        $data['page'] = $post;

        $agents = User::where('id', '!=', Auth::id())->get(); // Fetch agents
        $data['agents'] = $agents; // Pass agents to the view


        return view('admin.products.index', compact('basic', 'title', 'footertext'))->with($data)->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'agent_id' => 'required|exists:users,id', // Validate Product manager

        ]);

        if ($validator->passes()) {
            $testiId = $request->product_id;
            $testi =  [
                'name' => $request->name,
                'agent_id' => $request->agent_id, // Save the selected Product Manager
            ];

            $product = Product::updateOrCreate(['id' => $testiId], $testi);
            return response()->json(['code' => 200, 'success' => trans('langconvert.functions.productupdatecreate'), 'data' => $product], 200);
        } else {
            return Response::json(['errors' => $validator->errors()]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('Project Delete');
        $product = Product::find($id);
        $product->delete();

        return response()->json(['error' => trans('langconvert.functions.productdelete')]);
    }

    public function productmassdestroy(Request $request)
    {
        $product_id_array = $request->input('id');

        $products = Product::whereIn('id', $product_id_array)->get();

        foreach ($products as $product) {
            $product->delete();
        }
        return response()->json(['error' => trans('langconvert.functions.productdelete')]);
    }


    public function show($id)
    {
      $this->authorize('Project Edit');
        $post = Product::find($id);
        return response()->json($post);
    }
}
