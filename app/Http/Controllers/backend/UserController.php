<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = User::where('user.status','!=', 0)
        ->select(
        "user.id",
        "user.image",
        "user.name",
        "user.username",
        "user.email",
        "user.phone",        
        "user.address",
        "user.roles",
        "user.status")
        ->orderBy('user.created_at', 'desc')
        ->get();

        return view("backend.user.index", compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = new User();

            $user->name = $request->name;
            $slug = Str::of($user->name)->slug('-');
            $user->username = $request->username;
            $user->password = sha1($request->password);
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->roles = $request->roles;
            $user->status = $request->status;

            // Upload image
           if ($request->hasFile('image')) {
                $exten = $request->file('image')->extension();
                if (in_array($exten, ['jpg', 'png', 'gif', 'webp'])) {
                    $filename = $user->$slug . "." . $exten;
                    $request->image->move(public_path("images/users"), $filename);
                    $user->image = $filename;
                } else {
                    return back()->withErrors(['image' => 'Loại file không hợp lệ, chỉ chấp nhận jpg, png, gif, webp']);
                }
            }

            $user->created_at = date('Y-m-d H:i:s');
            $user->created_by = Auth::id() ?? 1;
            $user->save();

            return redirect()->route('admin.user.index')->with('message', ['type' => 'success', 'msg' => 'Sản phẩm được thêm thành công.']);
        } catch (\Exception $e) {
            // return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Có lỗi xảy ra, vui lòng thử lại!']);
            echo $e;
        }
    }


    /**
     * STATUS
     */ 
    public function status(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
    
        $user->status = ($user->status == 2) ? 1 : 2;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1;
    
        $user->save(); // Lưu
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user == null)
        {
            return redirect()->route('admin.user.index');
        }
        return view("backend.user.show", compact('user'));
    }

     /**
     * DELETE
     */ 
    public function delete(string $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return redirect()->route('admin.user.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Người dùng không tồn tại.'
            ]);
        }

        $user->status = 0;
        $user->updated_at = date('Ymd H:i:s');
        $user->updated_by = Auth::id() ?? 1;

        if ($user->save()) {
            return redirect()->route('admin.user.index')->with('message', [
                'type' => 'success',
                'msg' => 'Xóa người dùng thành công.'
            ]);
        } else {
            return redirect()->route('admin.user.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Xóa người dùng thất bại.'
            ]);
        }
    }

    /**
     * TRASH
     */ 
     public function trash()
     {
         $list = User::where('status', '=', 0)
         ->select('id', 'name', 'username', 'email', 'phone', 'roles', 'image', 'status')
         ->orderBy('created_at', 'desc')
         ->get();
         return view("backend.user.trash", compact('list'));
     }


      /**
     * RESTORE
     *  status restore status=2
     */   
    public function restore(string $id)
    {
        $user = User::find($id);
    
        if ($user == null) {
            return redirect()->route('admin.user.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Người dùng không tồn tại.'
            ]);
        }
    
        $user->status = 1;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1;
    
        if ($user->save()) {
            return redirect()->route('admin.user.trash')->with('message', [
                'type' => 'success',
                'msg' => 'Khôi phục người dùng thành công.'
            ]);
        } else {
            return redirect()->route('admin.user.trash')->with('message', [
                'type' => 'danger',
                'msg' => 'Khôi phục người dùng thất bại.'
            ]);
        }
    }


   /**
 * Show the form for editing the specified resource.
 */
public function edit(string $id)
{
    $user = User::find($id);
    if ($user == null)
    {
        return redirect()->route('admin.user.index');
    }
    return view("backend.user.edit", compact('user'));
}

/**
 * Update the specified resource in storage.
 */
public function update(UpdateUserRequest $request, string $id)
{
    try {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index')->with('message', ['type' => 'danger', 'msg' => 'Người dùng không tồn tại.']);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        if($request->password){
            $user->password = sha1($request->password);
        }
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->roles = $request->roles;
        $user->status = $request->status;

        // Upload image
        if ($request->hasFile('image')) {
            $exten = $request->file('image')->extension();
            if (in_array($exten, ['jpg', 'png', 'gif', 'webp'])) {
                $filename = Str::slug($user->name) . "." . $exten;
                $request->image->move(public_path("images/users"), $filename);
                $user->image = $filename;
            } else {
                return back()->withErrors(['image' => 'Loại file không hợp lệ, chỉ chấp nhận jpg, png, gif, webp']);
            }
        }

        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1;
        $user->save();

        return redirect()->route('admin.user.index')->with('message', ['type' => 'success', 'msg' => 'Cập nhật thông tin người dùng thành công.']);
    } catch (\Exception $e) {
        return redirect()->back()->with('message', ['type' => 'danger', 'msg' => 'Có lỗi xảy ra, vui lòng thử lại!']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return redirect()->route('admin.user.index')->with('message', [
                'type' => 'danger',
                'msg' => 'Người dùng không tồn tại.'
            ]);
        }

        if ($user->delete()) {
            return redirect()->route('admin.user.trash')->with('message', [
                'type' => 'warning',
                'msg' => 'Đã xóa người dùng khỏi CSDL.'
            ]);
        } else {
            return redirect()->route('admin.user.trash')->with('message', [
                'type' => 'danger',
                'msg' => 'Xóa người dùng khỏi CSDL thất bại.'
            ]);
        }
    }

}
