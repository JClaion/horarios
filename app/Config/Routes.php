<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Shield Auth routes
service('auth')->routes($routes);
service('auth')->routes($routes, ['except' => ['login', 'register']]);

$routes->get('/', 'Home::home');
$routes->get('/sys', 'Home::home');
$routes->get('/sys/home', 'Home::home');
$routes->get('/sys/em-construcao', 'Home::emConstrucao');


//cadastro cursos
$routes->get('/sys/cadastro-cursos', 'Cursos::cadastro');

//cadastro disciplinas
$routes->get('sys/cadastro-disciplinas', 'Disciplinas::cadastro');

//matriz curricular (em construção)
$routes->get('sys/matriz-curricular', 'MatrizCurricular::index');

//cadastro de turmas (em construção)
$routes->get('sys/cadastro-turmas', 'Turmas::index');

//cadastro de ambientes (em construção)
$routes->get('sys/cadastro-ambientes', 'Ambientes::index');

//cadastro de aulas (em construção)
$routes->get('sys/cadastro-aulas', 'Aulas::index');

//horarios de aula (em construção)
$routes->get('sys/cadastro-horarios-de-aula', 'TemposAula::cadastro');

//Relatórios (em construção)
$routes->get('sys/relatorios', 'Relatorios::index');

//adicionar o filter (middleware de login no group depois)
$routes->group('sys', function ($routes) {
    //CRUD Professor
    $routes->group('professor', function ($routes) {
        $routes->get('', 'Professor::index');
        $routes->get('listar', 'Professor::index');
        $routes->get('cadastro', 'Professor::cadastro');
        $routes->post('salvar', 'Professor::salvar');
        $routes->get('(:num)', 'Professor::professorPorId/$1');
        $routes->post('atualizar/(:num)', 'Professor::atualizar/$1');
        $routes->post('deletar/(:num)', 'Professor::deletar/$1');
        //Rota área de trabalho
        $routes->get('horarios', 'Professor::horarios');
    });
    $routes->group('disciplina', function ($routes) {
        //CRUD Disciplinas
        $routes->get('cadastro', 'Disciplinas::cadastro');
    });
    $routes->group('importacao', function ($routes) {
        // Rotas importacao planilhas
        $routes->get('/sys/importacao', 'Importacao::index');
        $routes->post('/sys/importacao/importar', 'Importacao::importar_planilha');
        $routes->get('/sys/professor/confirmar-importacao', 'Professor::validarImportacao');
        $routes->get('/sys/professor/importar-professor', 'Professor::importarProfessor');
    });
});
