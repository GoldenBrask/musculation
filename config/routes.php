<?php
return [
    ['GET', '/', 'HomeController#index'],
    ['GET', '/exercices', 'ExerciceController#index'],
    ['POST', '/exercice/create', 'ExerciceController#create'],
    ['GET', '/exercice/[i:id]', 'ExerciceController#show'],
    ['GET', '/performances', 'PerformanceController#index'],
    ['POST', '/performance/create', 'PerformanceController#create'],
    ['GET', '/performance/data', 'PerformanceController#data'],
    ['POST', '/performance/filter', 'PerformanceController#filter'],
];
