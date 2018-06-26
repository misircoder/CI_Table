# CI_Table
Making CI models never been easy like that.

## How to install?

Simply! Copy table.php to `/application/models/` folder. All done!

## How to make new model?

1. Create new model inside models folder.
2. Include table.php after `<?php` tag
3. Create your first CI_Table model class

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include 'table.php';

class MyModel extends Table_Model {

	public function __construct()
	{
    // In the constructor, you must define table name
    // Or you can use $this->set_table('table_name'); to define table name
		parent::__construct('table_name');
	}
}

?>
```

All done! Your first CI_Table model was created.

## Examples

#### 1. Load the model and fetch all table

```php
$this->load->model('mymodel');
$result = $this->mymodel->get();
```
```sql
SELECT * FROM `table_name`;
```

#### 2. Fetch table using where clause

```php
$result = $this->mymodel->get('id', 13);
```
```sql
SELECT * FROM `table_name` WHERE `id` == 13;
```

#### 3. Fetch table using more than one where clause

```php
// Method 1
$result = $this->mymodel->get(Array(
  'name' => 'John',
  'age'  => 20));
  
// Method 2
$result = $this->mymodel->where('name', 'John')->get('age', 20);

// Method 3
$result = $this->mymodel->where(Array(
  'name' => 'John',
  'age'  => 20))->get();
```
```sql
SELECT * FROM `table_name` WHERE `name` == 'John' AND `age` == 20;
```

#### 4. Insert new row(s) to the table

```php
$data['name'] = 'John';
$data['age']  = 20;
$this->mymodel->insert($data);

// or insert more than one row

$rows = Array(
  Array(
    'name' => 'John',
    'age'  => 20
  ),
  Array(
    'name' => 'Jessica',
    'age'  => 22
  )
);
```
```sql
INSERT INTO `table_name` (`name`, `age`) VALUES ('John', 20), ('Jessica', 22);
```
#### 5. Delete some row using where clause

```php
// Method 1
$this->mymodel->delete('id', 12);

// Method 2
$this->mymodel->where('id', 12)->delete();
```
```sql
DELETE FROM `table_name` WHERE `id` == 12;
```
> IN A LOT OF METHODS YOU CAN USE WHERE CLAUSE AS PARAMETER OR YOU CAN USE `->where(...)` METHOD TO DEFINE WHERE CLAUSE

#### 6. Change row using where clause

```php
$data['name'] = 'Daniel';
$this->mymodel->update($data, 'id', 12);
```
```sql
UPDATE TABLE `table_name` SET `name` = 'Daniel' WHERE `id` == 12;
```

#### 7. Get array that contains required `$_POST` fields

```php
$data = $this->mymodel->post_data(Array('name, 'email'));
```
This is same as:
```php
$data = Array(
  'name'  => $this->input->post('name'),
  'email' => $this->input->post('email')
);
```

#### 8. Count rows

```php
$count = $this->mymodel->count('name', 'John');
```
```sql
SELECT COUNT(*) FROM `table_name` WHERE `name` == 'John';
```

> IF YOU WANT TO COUNT ALL ROWS INSIDE TABLE THEN USE `$this->mymodel->count()` (without any argument)

#### 9. Limit, order

```php
// #1
$this->mymodel->limit(10);

// #2
$this->mymodel->limit(4, 13);

// #3
$this->mymodel->order_by('date', 'ASC');

// #4
$this->mymodel->order_by('date', 'DESC');
```
```sql
#1
... LIMIT 10
#2
... LIMIT 13, 4
#3
ORDER BY `date` ASC
#4
ORDER BY `date` DESC
```
Thanks for scrolling down. Please star for more opensource projects.
