<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::paginate(10);
        //$users = User::all();
        //dd($users);
        //return View('user/list')->with('user', $users);
       // return view('user/list', $users);

         $data = [ 
                    'user' => User::paginate(10)
                ];
    
            return view('user/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $user = new User;
      //return View::make('user/form')->with('user', $user);
      return view('user.form')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user = new User;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        //dd($data);
        // Revisamos si la data es válido
        if ($user->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $user->fill($data);
            $confirmation_code = str_random(30);
            $user->confirmation_code=$confirmation_code;
            // Guardamos el usuario
            $user->save();
           /* $data ['confirmation_code'] = $confirmation_code;
            Mail::send('emails.verify', $data, function($message) {
            $message->to(Input::get('email'), Input::get('firstName'))
                ->subject('Verifica tu dirección de correo ');
            });*/
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('user.show', array($user->id));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
        return Redirect::route('user.create')->withInput()->withErrors($user->errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if (is_null($user)) App::abort(404);
        
      return View::make('user/show', array('user' => $user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
            if (is_null ($user))
            {
            App::abort(404);
            }
        return View::make('user/form')->with('user', $user);
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
         $user = User::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null ($user))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($user->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $user->fill($data);
            //$user->idPersonModificator=$currentuser->id;
            // Guardamos el usuario
            $user->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('user.show', array($user->id));
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('user.edit', $user->id)->withInput()->withErrors($user->errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$currentuser= Auth::user(); 
            if($currentuser->isValidAdmin($currentuser)==false)
            {
                return Redirect::to('/errors')->withInput()->withErrors('you cant do that');
            }
        $user = User::find($id);
        $user->delete();
        
        if (is_null ($user))
        {
            App::abort(404);
        }
        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Usuario ' . $user->firstName . $user->lastName . ' eliminado',
            ));
        }
        else
        {
            return Redirect::route('home');
        }
    }
    
}
