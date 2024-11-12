Processos para executar o projeto

    composer install
    npm install,
    Configurar .env com nome do banco e senha(caso exista)

    php artisan key:generate
    php artisan storage:link
    php artisan migrate
    php artisan queue:work (caso esteja sendo executado localmente, criar uma tarefa dentro do agendador de tarefas)
    php artisan serve
    npm run dev


