<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Topic;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Menu::where('status','!=', 0)
        ->select(
        "id",
        "name",
        "link",
        "parent_id",
        "type",
        "position",
        "table_id",
        "sort_order",
        "status")
        ->orderBy('created_at', 'desc')
        ->get();

        $list_category = Category::where('status', '!=', 0)
        ->orderBy('created_at', 'DESC')
        ->select('id', 'name')
        ->get();

        $list_brand = Brand::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select('id','name')
            ->get();

        $list_topic = Topic::where('status', '!=', 0)
            ->orderBy('created_at','DESC')
            ->select ('id','name')
            ->get();

        $list_page = Post::where(['status' => 0, ['type','=','page']])
            ->orderBy ('title','ASC')
            ->select ('id','title') 
            ->get();

        return view("backend.menu.index", compact('list','list_category','list_brand','list_topic','list_page'));
    }


    /**
     * STATUS
     */ 
    public function status(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('admin.menu.index');
        }
    
        $menu->status = ($menu->status == 2) ? 1 : 2;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = Auth::id() ?? 1;
    
        $menu->save(); // Lưu
        return redirect()->route('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (isset($request->createCategory)) {
                $listid = $request->categoryid;
                if ($listid) {
                    foreach ($listid as $id) {
                        $category = Category::find($id);
                        if ($category != null) {
                            $menu = new Menu();
                            $menu->name = $category->name;
                            $menu->link = 'danh-muc/' . $category->slug;
                            $menu->sort_order = 0;
                            $menu->parent_id = 0;
                            $menu->type = 'category';
                            $menu->position = $request->position;
                            $menu->table_id = $id;
                            $menu->created_at = date('Y-m-d H:i:s');
                            $menu->created_by = Auth::id() ?? 1;
                            $menu->status = $request->status;
                            $menu->save();
                        }
                    }
                    return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Danh mục được thêm vào menu thành công.']);
                } else {
                    return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Không có danh mục nào được chọn.']);
                }
            }
    
            if (isset($request->createBrand)) {
                $listid = $request->brandid;
                if ($listid) {
                    foreach ($listid as $id) {
                        $brand = Brand::find($id);
                        if ($brand != null) {
                            $menu = new Menu();
                            $menu->name = $brand->name;
                            $menu->link = 'thuong-hieu/' . $brand->slug;
                            $menu->sort_order = 0;
                            $menu->parent_id = 0;
                            $menu->type = 'brand';
                            $menu->position = $request->position;
                            $menu->table_id = $id;
                            $menu->created_at = date('Y-m-d H:i:s');
                            $menu->created_by = Auth::id() ?? 1;
                            $menu->status = $request->status;
                            $menu->save();
                        }
                    }
                    return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Thương hiệu được thêm vào menu thành công.']);
                } else {
                    return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Không có thương hiệu nào được chọn.']);
                }
            }
    
            if (isset($request->createTopic)) {
                $listid = $request->topicid;
                if ($listid) {
                    foreach ($listid as $id) {
                        $topic = Topic::find($id);
                        if ($topic != null) {
                            $menu = new Menu();
                            $menu->name = $topic->name;
                            $menu->link = 'chu-de/' . $topic->slug;
                            $menu->sort_order = 0;
                            $menu->parent_id = 0;
                            $menu->type = 'topic';
                            $menu->position = $request->position;
                            $menu->table_id = $id;
                            $menu->created_at = date('Y-m-d H:i:s');
                            $menu->created_by = Auth::id() ?? 1;
                            $menu->status = $request->status;
                            $menu->save();
                        }
                    }
                    return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Chủ đề được thêm vào menu thành công.']);
                } else {
                    return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Không có chủ đề nào được chọn.']);
                }
            }
    
            if (isset($request->createPage)) {
                $listid = $request->pageid;
                if ($listid) {
                    foreach ($listid as $id) {
                        $page = Post::where([['id', '=', $id], ['type', '=', 'page']])->first();
                        if ($page != null) {
                            $menu = new Menu();
                            $menu->name = $page->title;
                            $menu->link = 'trang-don/' . $page->slug;
                            $menu->sort_order = 0;
                            $menu->parent_id = 0;
                            $menu->type = 'page';
                            $menu->position = $request->position;
                            $menu->table_id = $id;
                            $menu->created_at = date('Y-m-d H:i:s');
                            $menu->created_by = Auth::id() ?? 1;
                            $menu->status = $request->status;
                            $menu->save();
                        }
                    }
                    return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Trang được thêm vào menu thành công.']);
                } else {
                    return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Không có trang nào được chọn.']);
                }
            }
    
            if (isset($request->createCustom)) {
                if (isset($request->name, $request->link)) {
                    $menu = new Menu();
                    $menu->name = $request->name;
                    $menu->link = $request->link;
                    $menu->parent_id = 0;
                    $menu->sort_order = 0;
                    $menu->type = 'custom';
                    $menu->position = $request->position;
                    $menu->created_at = date('Y-m-d H:i:s');
                    $menu->created_by = auth()->id() ?? 1;
                    $menu->status = $request->status;
                    $menu->save();
                    return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Menu tùy chỉnh được thêm thành công.']);
                } else {
                    return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Vui lòng nhập tên và liên kết cho menu tùy chỉnh.']);
                }
            }
    
            return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Không có hành động nào được thực hiện.']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Có lỗi xảy ra, vui lòng thử lại!']);
        }
    }
    

      /**
     * DELETE
     */ 
    public function delete(string $id)
    {
        $menu = Menu::find($id);

        if ($menu == null) {
            return redirect()->route('admin.menu.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Menu không tồn tại.'
            ]);
        }

        $menu->status = 0;
        $menu->updated_at = date('Ymd H:i:s');
        $menu->updated_by = Auth::id() ?? 1;

        if ($menu->save()) {
            return redirect()->route('admin.menu.index')->with('message', [
                'type' => 'success',
                'msg' => 'Xóa Menu thành công.'
            ]);
        } else {
            return redirect()->route('admin.menu.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Xóa Menu thất bại.'
            ]);
        }
    }

     /**
     * TRASH
     */ 
    public function trash()
    {
        $list = Menu::where('status', '=', 0)
        ->select('id', 'name', 'link', 'sort_order', 'parent_id', 'position', 'type','status')
        ->orderBy('created_at', 'desc')
        ->get();
        return view("backend.menu.trash", compact('list'));
    }


      /**
     * RESTORE
     *  status restore status=2
     */   
    public function restore(string $id)
    {
        $menu = Menu::find($id);
    
        if ($menu == null) {
            return redirect()->route('admin.menu.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Menu không tồn tại.'
            ]);
        }
    
        $menu->status = 1;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = Auth::id() ?? 1;
    
        if ($menu->save()) {
            return redirect()->route('admin.menu.trash')->with('message', [
                'type' => 'success',
                'msg' => 'Khôi phục Menu thành công.'
            ]);
        } else {
            return redirect()->route('admin.menu.trash')->with('message', [
                'type' => 'danger',
                'msg' => 'Khôi phục Menu thất bại.'
            ]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('admin.menu.index')->with('message', ['type' => 'danger', 'msg' => 'Menu không tồn tại.']);
        }
        return view('backend.menu.edit', compact('menu'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $menu = Menu::find($id);
            if (!$menu) {
                return redirect()->route('admin.menu.index')->with('message', ['type' => 'danger', 'msg' => 'Menu không tồn tại.']);
            }

            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->position = $request->position;
            $menu->status = $request->status;
            $menu->updated_at = date('Y-m-d H:i:s');
            $menu->updated_by = Auth::id() ?? 1;
            $menu->save();

            return redirect()->route('admin.menu.index')->with('message', ['type' => 'success', 'msg' => 'Menu được cập nhật thành công.']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Có lỗi xảy ra, vui lòng thử lại!']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);

        if ($menu == null) {
            return redirect()->route('admin.menu.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Menu không tồn tại.'
            ]);
        }

        if ($menu->delete()) {
            return redirect()->route('admin.menu.trash')->with('message', [
                'type' => 'warning',
                'msg' => 'Đã xóa Menu khỏi CSDL.'
            ]);
        } else {
            return redirect()->route('admin.menu.trash')->with('message', [
                'type' => 'danger',
                'msg' => 'Xóa Menu khỏi CSDL thất bại.'
            ]);
        }
    }
}
