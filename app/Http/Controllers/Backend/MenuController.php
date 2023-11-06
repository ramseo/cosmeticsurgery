<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Http\Requests\MenusRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use \stdClass;

class MenuController extends Controller
{

    use Authorizable;

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource. 
     *
     * @return Response
     */
    public function index($menu_id, Request $request)
    {
        $menuName = DB::table('menutype')->where('menu_id', $menu_id)->select('title')->first();
        $menus = Menu::Where('menu_id', $menu_id)->Where('parent_id', 0)->orderBy('sortable')->select(['id', 'title', 'url', 'menu_id', 'parent_id', 'sort'])->get();

        if ($request->ajax()) {
            return Datatables::of($menus)
                ->addIndexColumn()
                ->rawColumns()
                ->make(true);
        }
        return view('backend.menu.index_datatable', compact('menus', 'menuName', 'menu_id'))->with('menu_id', $menu_id);
    }

    public function sortable(Request $request)
    {
        parse_str($request->data, $output);

        $i = 0;
        if ($output) {
            foreach ($output['menu'] as $value) {
                DB::table('menuitem')
                    ->where('id', $value)
                    ->update(['sortable' => $i]);
                $i++;
            }
            $response['status'] = true;
            $response['msg'] = "Successfully Sorted";
        } else {
            $response['status'] = false;
            $response['msg'] = "Failed To Sort";
        }

        echo json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($menu_id)
    {
        $module_title = 'Menu Type';
        $module_name = 'menu';
        $module_action = 'Menu Item Create';
        $menuTypeName = DB::table('menutype')->where('menu_id', $menu_id)->select('title')->first();

        $menuData = new stdClass();
        $menuData->title = '';
        $menuData->url = '';
        $menuData->id = '';
        $menuData->parent_id = '';

        return view(
            "backend.$module_name.create",
            compact('module_title', 'module_name', 'module_action', 'menu_id', 'menuTypeName', 'menuData')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store($menu_id, MenusRequest $request)
    {
        $module_title = 'Menu';
        $module_name = 'menus';

        if ($request->input('url')) {
            $url = $request->input('url');
        } else {
            $url = \Str::slug($request->title);
        }

        $data = array(
            '_token' => $request->_token,
            'title' => $request->title,
            'menu_id' => $menu_id,
            'url' =>  $url,
            'parent_id' =>  $request->parent_id,
        );

        $menu = Menu::create($data);
        Flash::success("<i class='fas fa-check'></i> New '" . Str::singular($module_title) . "' Added")->important();
        return redirect("admin/$module_name/$menu_id");
    }

    public function edit($id)
    {
        $module_title = 'Menu';
        $module_name = 'menus';
        $module_action = 'Menu Item Edit';

        $menuData = Menu::findOrFail($id);
        $menu_id = $menuData->menu_id;
        $menuTypeName = DB::table('menutype')->where('menu_id', $menu_id)->select('title')->first();

        return view(
            "backend.menu.edit",
            compact('module_title', 'module_name', 'menuData', 'module_action', 'menu_id', 'menuTypeName')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */

    public function update($menu_id, $id, Request $request)
    {
        $module_title = 'Menu';
        $module_name = 'menus';
        $module_action = 'Update';

        $menutype = Menu::where('menu_id', $menu_id)->where('id', $id)->firstOrFail();
        $menutype->title = $request->input('title');
        $menutype->url = $request->input('url');
        $menutype->parent_id = $request->input('parent_id');
        $menutype->update();

        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Updated Successfully")->important();

        return redirect("admin/$module_name/$menu_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($menu_id, $id)
    {
        $module_title = 'Menu';
        $module_name = 'menus';

        DB::table('menuitem')->where('id', $id)->where('menu_id', $menu_id)->delete();

        Flash::success('<i class="fas fa-check"></i> ' . label_case($module_title) . ' Deleted Successfully!')->important();
        return redirect("admin/$module_name/$menu_id");
    }
}
