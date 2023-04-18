<?php

    namespace App\Http\Controllers\backend;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Services\BackendServices\AdminServices;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class AdminController extends Controller
    {
        protected $_services;

        public function __construct(AdminServices $services)
        {
            $this->_services = $services;
        }

        public function index(Request $request)
        {
            $keyWord = $request->input('keyword') ?? '';
            $account = $this->_services->getAllAdminAccount(10, $keyWord);

            return view('backend.account.index')->with(compact('account','account'));
        }
        public function create() {
            $data = $this->_services->getFormAddAdmin();
            
            return view('backend.account.create-account', compact('data'));
        }
        public function createAccount(Request $request) {
            $request->validate([
                'name'=>'required|max:255',
                'username' => 'required',
                'email' =>'required',
            ]);
            
            if($this->_services->storeAccount($request)) {
                return redirect()->route('account-list')->with(['success' => 'Thêm tài khoản thành công!']);
            }
            return back()->with(['error' => 'Đã có lỗi xảy ra!']);
        }
        public function edit($id) {
            $data = $this->_services->getFormUpdate($id);
            return view('backend.account.update-account', compact('data'));
        }
        public function postEdit(Request $request) {
            $request->validate([
                'name'=>'required|max:255',
                'username' => 'required',
                'email' =>'required',
            ]);

            if($request->file('avatar')) {
                $request->validate([
                    'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            }
            
            if($this->_services->updateAccount($request)) {
                return redirect()->route('account-list', $request->status)->with(['success' => 'Update tài khoản thành công!']);
            }
            
            // return back()->with(['error' => 'Đã có lỗi xảy ra!']);
        }
        public function profile(Request $request){
            $profile = $this->_services->getProfile();
            if($request->isMethod('post')){
                if($request->file('avatar')) {
                    $request->validate([
                        'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
                        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

                    ]);
                }
                $request->id = $profile->id;
                $this->_services->updateAccount($request);
            }
            $profile = $this->_services->getProfile();
            if($profile){
                return view('backend.account.profile', compact('profile'));
            }else{
                return back()->with(['error' => 'Đã có lỗi xảy ra!']);
            }

        }
        
    }
