<?php

// This class may not be instantiated
// Extend it instead (as in 'public User extends Model') It now has full database CRUD
abstract class Model {

    // Every model has an id
    protected $id;

    // When extending this class, create protected variables in the subclass and match the property
    // names with the column names in the database (case sensitive)

    public function save() {
        if($this->id ){
            // If the object hasn't been inserted before
            $this->update();
        } else {
            // If it has been
            $this->create();
        }
    }

    // Keep these private! Don't use these functions yourself. Instead, call save()
    private function create() {
        if(static::newModel($this)) {
            $vars = get_object_vars($this);

            unset($vars['id']);

            $table = strtolower(get_class($this));

            $fields = "(`" . implode("`, `", array_keys($vars)) . "`)";
            $values = "(:" . implode(", :", array_keys($vars)) . ")";

            $qry = "INSERT INTO `$table` $fields VALUES $values;";

            $stmt = DB::prepare($qry);

            $stmt->execute($vars);
            $this->id = DB::lastId();
        }
    }

    // Keep these private! Don't use these functions yourself. Instead, call save()
    private function update() {
        $vars = get_object_vars($this);

        $table = strtolower(get_class($this));

        $qry = "UPDATE `$table` SET ";

        foreach($vars as $col => $value) {
            if($col == 'id') continue;
            $qry .= "$col = :$col, ";
        }

        $qry = substr($qry, 0, -2);

        $qry .= " WHERE id = :id";

        $stmt = DB::prepare($qry);
        $stmt->execute($vars);
    }

    protected function belongsTo($type, $field = ""){
        if($field == ""){
            $field = strtolower($type);
        }
        return $type::findById(get_object_vars($this)[$field]);
    }

    protected function hasMany($type, $field = ""){
        if($field == ""){
            $field = strtolower(get_called_class());
        }
        return $type::findBy($field, $this->getId());
    }

    // This removes the object from the database
    public function remove() {
        $table = strtolower(get_called_class());
        $qry = "DELETE FROM `$table` WHERE id = :id";
        $stmt = DB::prepare($qry);
        $stmt->execute(['id' => $this->id]);
        // Set ID to null. If it is referenced from something different it returns null
        // If it is saved to the database again this ensures it calls 'create'
        $this->id = null;
    }

    public static function saveTableRow($form){
        if(isset($form['id'])){
            self::updateValues($form);
            App::refresh();
        }
        elseif (count($form) > 0){
            $class = get_called_class();
            $obj = new $class();
            foreach ($form as $key => $value){
                $obj->$key = $value;
            }
            $obj->save();
            if($obj->getId()) {
                App::refresh();
            }
            else{
                App::addError("Did not save the new $class to the database");
            }
        }
    }

    public static function updateValues($form){
        $obj = self::findById($form['id']);
        unset($form['id']);
        foreach ($form as $name => $value){
            $obj->$name = $value;
        }
        $obj->save();
    }

    protected abstract static function newModel($obj);

    // Find every row in a table
    public static function find() {
        $table = strtolower(get_called_class());
        $qry = "SELECT * FROM `$table`";
        $stmt = DB::prepare($qry);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }

    public function getId() {
        return $this->id;
    }

    public static function findBy($field, $value) {
        return DB::getBy(get_called_class(), $field, $value);
    }

    public static function findById($id) {
        return self::findBy("id", $id)[0];
    }

}