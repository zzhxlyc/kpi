<?php

Model::load(array('AppModel', 'User', 'UserType', 
				'UserLimit', 'KpiItemType', 'KpiDataType', 'KpiDataStatus'));

App::load('util', 'FileSystem');

include(LIB_DIR.'/AppController.php');
include(LIB_DIR.'/functions.php');