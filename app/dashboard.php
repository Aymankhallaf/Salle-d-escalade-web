<?php
include 'includes/_header.php';
?>
<main>

    <h1 class="dashboard-ttl" id="reservation">Réservation</h1>
    <nav>
        <ul class="dashboard-menu">
            <li><a class="dashboard-menu__a" href="#">Profil</a></li>
            <li><a class="dashboard-menu__a dashboard-menu__a-current" href="#">Réservation</a></li>
            <li><a class="dashboard-menu__a" href="#">Abonnement</a></li>
        </ul>
    </nav>
    <section>
        <h2 class="dashboard-ttl" id="reservation">Réservation détails:</h2>



        <table>
            <tr>
                <th>Salle</th>
                <td>Salle1</td>
            </tr>
            <tr>
                <th>Date de réservation</th>
                <td>14/07/2024 8:30</td>
            </tr>
            <tr>
                <th>Durée</th>
                <td>1h</td>
            </tr>
            <tr>
                <th>Total Prix</th>
                <td>50€</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>Payé</td>
            </tr>
        </table>
    </section>

</main>

<?php
include 'includes/_footer.php';
?>
</body>

</html>