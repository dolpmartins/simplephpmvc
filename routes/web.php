<?php


Router::get('','HomeController@Home');
Router::get('home','HomeController@Home');
/*Products Type routes*/
Router::get('productType','ProductTypeController@Index');
Router::get('productType/create','ProductTypeController@Create');
Router::get('productType/edit/{id}','ProductTypeController@Edit');
Router::delete('productType/delete/{id}','ProductTypeController@Delete');
Router::post('productType/save','ProductTypeController@Save');
Router::post('productType/update/{id}','ProductTypeController@Update');
/*Products routes*/
Router::get('product','ProductController@Index');
Router::get('product/create','ProductController@Create');
Router::get('product/edit/{id}','ProductController@Edit');
Router::delete('product/delete/{id}','ProductController@Delete');
Router::post('product/save','ProductController@Save');
Router::post('product/update/{id}','ProductController@Update');
/*Sale routes*/
Router::get('sale','SaleController@Index');
Router::post('sale/save','SaleController@Save');
?>