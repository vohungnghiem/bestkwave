<?php

// year
function year($date)
{
    return date('Y', strtotime($date));
}
// month
function month($date)
{
    return date('m',strtotime($date));
}
// explodes
function explodesnot($data){
    $explodes = explode(",",$data);
    foreach ($explodes as $explode) {
        if ($explode) {
            $explodez = explode("|",$explode);
            echo '<a href="'.$explodez[1].'" target="_blank"><i class="fab fa-'.$explodez[0].'-square fa-2x"></i></a> ';
        }
    }
}
// category dequy
function showCategories($categories, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent == $parent_id)
        {
            echo '<option value="'.$item->id.'">';
                echo $char . $item->title;
            echo '</option>';
            // unset($categories[$key]);
            showCategories($categories, $item->id, $char.'|---');
        }
    }
}

// category dequy
function showCategoriesSelected($categories, $parent_id = 0, $char = '---',$id)
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent == $parent_id)
        {
            if ($item->id == $id)
            {
                echo "<option value='$item->id' selected>";
                echo $char . $item->title;
                echo '</option>';
            }else{
                echo "<option value='$item->id'>";
                echo $char . $item->title;
                echo '</option>';
            }

            showCategoriesSelected($categories, $item->id, $char.'|---',$id);
        }
    }
}

// category dequy
function editCategoriesSelected($categories, $parent_id = 0, $char = '',$id)
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent == $parent_id)
        {
            if ($item->id == $id)
            {
                echo '<p class="current">'.$char . $item->title.'</p>';
            }else{
                echo '<p>'.$char . $item->title.'</p>';
            }

            editCategoriesSelected($categories, $item->id, $char.'<i class="fas fa-ellipsis-h"></i> &nbsp;',$id);
        }
    }
}