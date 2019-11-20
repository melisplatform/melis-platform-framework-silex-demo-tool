-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2019 at 09:44 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

# Update alb_date from date to timestamp

ALTER TABLE `melis_demo_album` CHANGE `alb_id` `alb_id` INT(11) NOT NULL AUTO_INCREMENT;
