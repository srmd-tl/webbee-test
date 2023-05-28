<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
   
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
    public static function getMenuItems($parentId = null)
    {
        $menuItems = self::where('parent_id', $parentId)->get();
    
        foreach ($menuItems as $menuItem) {
            $menuItem->children = self::getMenuItems($menuItem->id);
        }
    
        return $menuItems;
    }
    

}
