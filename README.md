##Installazione:

<li>Eseguire nella shell il comando: "<strong>composer install</strong>" </li>
<li>Creare il file "<strong>database.sqlite</strong>" nella cartella "<strong>database</strong>"</li>
<li>Eseguire nella shell il comando: "<strong>php artisan migrate --seed</strong>"</li>
<li>Eseguire nella shell il comando: "<strong>php artisan serve</strong>" per avviare il server locale</li>
<li>Per accedere al sito collegarsi a <a href="localhost:8000"><strong>localhost:8000</strong></a></li>
<li>Registrarsi al sito con username,email e password</li>
<li>Per diventare admin fare il login e visitare <a href="localhost:8000/admin"><strong>localhost:8000/admin</strong></a></li>
<li>Scaricare ed eseguire <a href="https://github.com/mailhog/MailHog">Mailhog</a></li>
<li>Per controllare le email generate collegarsi ad <a href="localhost:8025/">localhost:8025</a></li>
<p>Con il seed del database vengono creati 10 utenti iscritti alla roulette e una lista di 10 posti fittizi dove è possibile pranzare.<br>
Tutte le impostazioni sono settabili dalla pagina <strong>"Settings"</strong> disponibile una volta diventati <strong>admin</strong>.<br>
</p>
