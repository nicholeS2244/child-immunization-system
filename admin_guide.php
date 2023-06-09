<?php
include "PHP/connection.php";
include "PHP/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Guide | Admin</title>
    <link rel= "stylesheet" href = "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    <link rel="stylesheet" href="CSS/admin_guide.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
          <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Child Immunization</label>
        <ul>
          <li><a href="admin_index.php"><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
          <li><a href="admin_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
          <li><a href="admin_guide.php" class="active"><i class="fas fa-book"  id="icon"></i>Nutrition Guide</a></li>
          <li><a href="admin_sms.php"><i class="fas fa-comment"  id="icon"></i>SMS Notification</a></li>
        
          <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
            <a href="logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
            </div>
          </div>
        </ul>
      </nav>

        <!-- Table -->
      
      <center><header class="head"><i class="fa fa-book"></i>Nutrition Guide</header></center>
      <center><table class="table" style="width: 50%">
      <thead>
        <th>Healthy Foods</th>
        <th>Benefits</th>
      </thead>
      <tbody>
        <tr>
          <td data-label="Healthy Food" style="text-align: center;">1. Fruit and vegetables 
                    <br>Fruit and vegetables give your child energy, vitamins, anti-oxidants, fibre and water.
          </td>
          <td data-label="Benefits">These nutrients help to protect your baby from diseases later in life, including diseases like heart disease, stroke and some cancers.
                    It’s a good idea to offer your baby fruit and vegetables at every meal and 
                    for snacks. Try to choose fruit and vegies of different colours, tastes and 
                    textures, both fresh and cooked.</td>
        </tr>
        <tr>
          <td data-label="Healthy Food" style="text-align: center;">2. Grain foods
                    <br>Grain foods include bread, pasta, noodles, breakfast cereals, couscous, rice, corn, quinoa, polenta, oats and barley.
                    
          </td>
          <td data-label="Benefits">These foods give children the energy they need to grow, develop and learn.
                   Grain foods with a low glycaemic index, like wholegrain pasta and breads, will give your child longer-lasting energy and keep them feeling fuller for longer.</td>
        </tr>
        <tr>
          <td data-label="Healthy Food" style="text-align: center;">3. Dairy <br>Key dairy foods are milk, cheese and yoghurt.           
          </td>
          <td data-label="Benefits">These foods are good sources of protein and calcium.

Dairy foods can be introduced from around six months of age. But make sure that breastmilk or infant formula is your baby’s main drink until around 12 months of age, when most children are eating family meals. After that, you can give your child full-fat cow’s milk if they’re eating a balanced diet.

Because children in this age group are growing so quickly and need a lot of energy, they need full-fat dairy products until they turn two.</td>
        </tr>
        <tr>
          <td data-label="Healthy Food" style="text-align: center;">4. Protein
            Protein-rich foods include lean meat, fish, chicken, eggs, beans, lentils, chickpeas, tofu and nuts.
          </td>
          <td data-label="Benefits">These foods are important for your child’s growth and muscle development.

These foods also contain other useful vitamins and minerals like iron, zinc, vitamin B12 and omega-3 fatty acids. Iron and omega-3 fatty acids from red meat and oily fish are particularly important for your child’s brain development and learning.</td>
        </tr>
        <tr>
          <td data-label="Healthy Food" style="text-align: center;">5. Healthy drinks
            Water is the healthiest drink for children over 12 months. It’s also the cheapest.
          </td>
          <td data-label="Benefits">Most tap water is fortified with fluoride for strong teeth too.
              From six months, breastfed and formula-fed babies can have small amounts of cooled boiled tap water from a cup.</td>
        </tr>
      </tbody>
    </table></center>
    <div class="container">
       <h1 style="text-align: center;">Reminders!</h1>
       <div class="content">
       <ul class="rem" style="text-align: justify;">
         <li>Wash fruit to remove dirt or chemicals, and leave any edible skin on, because the skin contains nutrients too.</li>
         <li>If you’re thinking of feeding your baby dairy alternatives, it’s best to talk to your paediatrician, GP or child and family health nurse.</li>
       <p>Foods and drinks to limit</p>  
         <li>It’s best to limit the amount of ‘sometimes’ food your child eats. This means your child will have more room for healthy, everyday foods.</li>
         <li>‘Sometimes’ foods include fast food, takeaway and junk food like hot chips, potato chips, dim sims, pies, burgers and takeaway pizza. These foods
          also include cakes, chocolate, lollies, biscuits, doughnuts and pastries.</li>  
         <li>‘Sometimes’ foods can be high in salt, saturated fat and sugar, and low in fibre. Regularly eating these foods can increase the risk of health conditions like childhood obesity and type-2 diabetes.</li>
         <li>You should also limit sweet drinks for your child, including fruit juice, cordials, sports drinks, flavoured waters, soft drinks and flavoured milks. Sweet drinks are high in sugar and low in nutrients.</li>
         <li>Too many sweet drinks can lead to unhealthy weight gain, obesity and tooth decay. These drinks fill your child up and can make them less hungry for healthy meals. If children regularly have sweet drinks when they’re young, it can kick off an unhealthy lifelong habit.</li>
         <li>Foods and drinks with caffeine aren’t recommended for children, because caffeine stops the body from absorbing calcium well. Caffeine is also a stimulant, which means it gives children artificial energy. These foods and drinks include coffee, tea, energy drinks and chocolate.</li>
       <p>Healthy alternatives for snacks and desserts</p>
         <li>It’s fine to offer your child snacks, but try to make sure they’re healthy. Fruit and vegetables are a good choice – for example, grated or thinly sliced carrot or apple.</li>
         <li>The same goes for dessert at the end of a meal. Sliced fruit or yoghurt are healthy options. If you want to serve something special, try homemade banana bread. Save the seriously sweet stuff, like cakes and chocolate, for special occasions like birthdays.</li>     
        </ul>
        </div>
    </div>          
<!-- Datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>