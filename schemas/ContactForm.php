<?php

namespace sprint\schemas;

use \sprint\database\schema\Schema;
use \sprint\database\schema\BluePrintSchema;

class ContactForm extends Schema
{	
    public function upgrade()
    {
        $this->run("contact_form", function(BluePrintSchema $table)
        {
			$table->int("id")->autoIncreament()->primaryKey();

			$table->varchar("name");
			
			$table->varchar("email");
			
			$table->text("message");

			$table->dateTime("created_at","CURRENT_TIMESTAMP");

			$table->dateTime("updated_at");

			$table->create();
		});
    }
    
    public function downgrade()
    {
        
    }
}