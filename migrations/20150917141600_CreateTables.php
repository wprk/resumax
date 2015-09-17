<?php

use Phpmig\Migration\Migration;

class CreateTables extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->createUsersTable();
        $this->createUserCustomFieldsTable();
        $this->createUserPersonalProfileTable();
        $this->createUserPreviousRoleTable();
        $this->createUserPreviousRoleResponsibilityTable();
        $this->createTagsTable();
        $this->createUserLinkTable();
        $this->createLinksTable();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->dropUsersTable();
        $this->dropUserCustomFieldsTable();
        $this->dropUserPersonalProfileTable();
        $this->dropUserPreviousRoleTable();
        $this->dropUserPreviousRoleResponsibilityTable();
        $this->dropTagsTable();
        $this->dropUserLinkTable();
        $this->dropLinksTable();
    }

    /**
     * Create Users Table
     */
    public function createUsersTable()
    {
        $sql = "CREATE TABLE `users` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(100) NOT NULL DEFAULT '',
            `password` VARCHAR(255) NULL DEFAULT NULL,
            `salt` VARCHAR(255) NOT NULL DEFAULT '',
            `roles` VARCHAR(255) NOT NULL DEFAULT '',
            `name` VARCHAR(100) NOT NULL DEFAULT '',
            `time_created` INT(11) UNSIGNED NOT NULL DEFAULT '0',
            `username` VARCHAR(100) NULL DEFAULT NULL,
            `isEnabled` TINYINT(1) NOT NULL DEFAULT '1',
            `confirmationToken` VARCHAR(100) NULL DEFAULT NULL,
            `timePasswordResetRequested` INT(11) UNSIGNED NULL DEFAULT NULL,
            `user_custom_fields_user_id` INT(11) UNSIGNED NOT NULL,
            `user_custom_fields_attribute` VARCHAR(50) NOT NULL,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create user_custom_field Table
     */
    public function createUserCustomFieldsTable()
    {
        $sql = "CREATE TABLE `user_custom_fields` (
            `user_id` INT(11) UNSIGNED NOT NULL,
            `attribute` VARCHAR(50) NOT NULL DEFAULT '',
            `value` VARCHAR(255) NULL DEFAULT NULL,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`user_id`, `attribute`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create user_personal_profile Table
     */
    public function createUserPersonalProfileTable()
    {
        $sql = "CREATE TABLE `user_personal_profile` (
            `profile_id` INT(14) UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) UNSIGNED NOT NULL,
            `profile_name` VARCHAR(50) NOT NULL,
            `profile_content` TEXT(500) NOT NULL,
            `default` TINYINT(1) NOT NULL,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`profile_id`),
            INDEX `UNIQUE` (`user_id` ASC, `profile_name` ASC)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create user_previous_role Table
     */
    public function createUserPreviousRoleTable()
    {
        $sql = "CREATE TABLE `user_previous_role` (
            `role_id` INT(14) UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` INT(11) UNSIGNED NOT NULL,
            `sector_id` INT(4) UNSIGNED NOT NULL,
            `start_date_day` INT(2) NULL,
            `start_date_month` INT(2) NULL,
            `start_date_year` INT(4) NULL,
            `current_employer` TINYINT(1) NULL DEFAULT 0,
            `end_date_day` INT(2) NULL,
            `end_date_month` INT(2) NULL,
            `end_date_year` INT(4) NULL,
            `Location` VARCHAR(255) NULL,
            `hiring_manager` INT(11) UNSIGNED NULL,
            `verified` TINYINT(1) NULL DEFAULT 0,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`role_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create user_previous_role_responsibility Table
     */
    public function createUserPreviousRoleResponsibilityTable()
    {
        $sql = "CREATE TABLE `user_previous_role_responsibility` (
            `responsibility_id` INT(14) UNSIGNED NOT NULL AUTO_INCREMENT,
            `role_id` INT(14) UNSIGNED NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `content` TEXT(500) NOT NULL,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`responsibility_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create tags Table
     */
    public function createTagsTable()
    {
        $sql = "CREATE TABLE `tags` (
            `tag_id` INT(20) UNSIGNED NOT NULL,
            `foreign_key_id` INT(14) UNSIGNED NULL,
            `type` ENUM('profile', 'role', 'responsibility') NOT NULL,
            `tags` VARCHAR(255) NOT NULL,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`tag_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create user_link Table
     */
    public function createUserLinkTable()
    {
        $sql = "CREATE TABLE `user_link` (
            `link_id` INT(14) UNSIGNED NOT NULL,
            `type_id` INT(5) UNSIGNED NOT NULL,
            `user_id` INT(11) UNSIGNED NULL,
            `location` VARCHAR(255) NULL,
            `created` datetime NOT NULL,
            `modified` datetime DEFAULT NULL,
            `removed` datetime DEFAULT NULL,
            `removed_flag` TINYINT(1) DEFAULT '0',
            PRIMARY KEY (`link_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Create links Table
     */
    public function createLinksTable()
    {
        $sql = "CREATE TABLE `links` (
            `type_id` INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
            `format` VARCHAR(255) NOT NULL,
            `name` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`type_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop users Table
     */
    public function dropUsersTable()
    {
        $sql = "DROP TABLE `users`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop user_custom_field Table
     */
    public function dropUserCustomFieldsTable()
    {
        $sql = "DROP TABLE `users_custom_field`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop user_personal_profile Table
     */
    public function dropUserPersonalProfileTable()
    {
        $sql = "DROP TABLE `users_custom_fields`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop user_previous_role Table
     */
    public function dropUserPreviousRoleTable()
    {
        $sql = "DROP TABLE `user_previous_role`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop user_previous_role_responsibility Table
     */
    public function dropUserPreviousRoleResponsibilityTable()
    {
        $sql = "DROP TABLE `user_previous_role_responsibility`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop tags Table
     */
    public function dropTagsTable()
    {
        $sql = "DROP TABLE `tags`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop user_links Table
     */
    public function dropUserLinksTable()
    {
        $sql = "DROP TABLE `user_links`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Drop links Table
     */
    public function dropLinksTable()
    {
        $sql = "DROP TABLE `links`;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
