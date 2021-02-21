<?php

namespace App\Table;

use Core\Table\Table;

// `id_user` int(11) NOT NULL AUTO_INCREMENT,
// `email` varchar(255) NOT NULL,
// `password` varchar(255) NOT NULL,
// `user_type` enum('prop','client','gerant','admin') NOT NULL,
// `valide` tinyint(4) DEFAULT NULL,
// `changeMDP` tinyint(4) NOT NULL DEFAULT '1',
// `created_by` int(11) NOT NULL,
// `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

class CategoryTable extends Table {
    
    protected $table = 'category';
}
