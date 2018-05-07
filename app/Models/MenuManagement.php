<?php
//10-day 菜单管理模型
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MenuManagement extends Model
{
    //
    protected $table='menu_management';

    protected $fillable=['name','menu_route','sorting','parent_id'];

    static public function navs(){
        $html='';
        $menus= self::where('parent_id',0)->get();
        foreach ($menus as $menu){
            $children_html='';
            $children=self::where('parent_id',$menu->id)->get();
            if(Auth::user()){
                foreach ($children as $child){
                    if(Auth::user()->can($child->menu_route)){
                        $children_html.= '
                <li><a href="'.route($child->menu_route).'">'.$child->name.'</a></li>
                <li role="separator" class="divider"></li>
                ';
                    }
                }
            }
            if($children_html==''){
                continue;
            }
            $html.= '
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu->name.'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';

            $html.=$children_html;
            $html.= '</ul></li>';
        }
        return $html;
    }
}
