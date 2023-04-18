<?php


	namespace App\Repository\Backend;

    use App\Models\User as Model;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;


    class UserRepository implements Contracts\UserRepositoryInterface
	{
	    protected $_model;

	    public function __construct(Model $model)
        {
            $this->_model = $model;
        }

        public function getAllUser() {
	        return $this->_model->all();
        }

        public function createOrLogin($user, $platform) {
            return User::updateOrCreate([
                'id_social' => $user->getId(),
            ],[
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'platform' => $platform,
                'password' => Hash::make($user->getName().'@'.$user->getId())
            ]);
        }

        public function save(Request $request) {
	       return $this->_model->create([
	            'name' => $request->name,
	            'email' => $request->email,
	            'password' => $request->password,
	            'gender' => $request->gender ?? null,
	            'avatar' => $request->avatar ?? null,
	            'status' => 1,
            ]);
        }

    }
