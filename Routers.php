<?php
use sprint\sroute\SRoute;

use sprint\http\controllers\ContactForm;

SRoute::get("/", [ContactForm::class, "index"]);
SRoute::post("/contacts-form/datatable", [ContactForm::class, "datatable"]);
SRoute::get("/contacts-form/details/{id}", [ContactForm::class, "details"]);
SRoute::post("/contacts-form/create", [ContactForm::class, "create"]);
SRoute::get("/contacts-form/save/{id}", [ContactForm::class, "save"]);
SRoute::post("/contacts-form/save/{id}", [ContactForm::class, "save"]);
SRoute::delete("/contacts-form/remove/{id}", [ContactForm::class, "remove"]);

SRoute::run();