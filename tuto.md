# Calculer l'age en php
L'objectif de cet exercice est de developper en PHP une petite application qui calcul l'age actuel de l'utilisateur en fonction de sa date de naissance.

## Le formulaire en html
On commence par générer une balise ```<form>``` et on renseigne le paramètre ```method = "post"``` de façon à faire passer l'information rensseignée, et on rredirige vers une page de tratement en PHP avec le paramètre ```action = ""```. Dans ce formulaire, on place 2 ```input```, l'un de type ```text```, l'autre de type ```submit```. On donne une value à ce dernier.

```
<form class="" action="traitement.php" method="post">
  <input type="text" name="" value="">
  <input type="submit" name="" value="envoyer">
</form>
```

## La logique en php
Notre application va simplement opérer un calcul arithmétique : soustraire l'année de naissance de l'utilisateur à l'année courante. Pour ce faire, on ouvre une balise ```<?php>``` dans laquelle on déclare une variable << birthdate >> en faisant précéder son nom du signe << $ >>, puis on lui affecte dans un premier temps une valeur de type number : la date de naissace du programmeur. On déclare une seconde variable ```$year``` à laquelle on affecte aussi une valeur fr type number : l'année en cours. On déclare une troisiemme variable ```$age```, on lui affecte la variable ```year``` suivit de l'opérateur arithmétique "-" puis de la variable ```$birthdate```. Enfin on ferme la balise PHP.

```
<?php
$birthdate=1997;
$year=2020;
$age=$year-$birthdate;
echo $age;
?>

```
## La récuperation dynamique des informations
Dans la 1ere partie nous avions attribué la methode ```post``` a la div ```<form>```, nous allons maintenant récupérer l'information entrée par l'utilisateur dans la page qui fait le traitement en PHP.

Pour ce faire nous allons utiliser la variable superglobale ```$_POST```.
Une 'superglobale' signifie simplement que cette variable est disponible dans tous les contextes du script.

```
  $birthdate=$_POST['birthdate'];

```
Maintenant, nous allons demander à PHP de récupérer l'année en cours. Pour cela, nous allons utiliser la fonction ```date()``` à laquelle nous passons en paramètre la chaine de caractère ```"Y"```.

## Vérification sur le champs de formulaire

On va maintenant vérifier que la variable superglobale ```$_POST``` est paramétrée en utilisant une condition if à laquelle on passe en paramètre la fonction ```isset```..

```
if (isset($_POST['birthdate'])){
  $birthdate=$_POST['birthdate'];
  $year=date('Y');
  $age=$year-$birthdate;
  echo '<p>vous avez '. $age. ' ans.</p>';
}
```

## Calcul de l'age exact (jour,mois,année)
### Modification du html

Dans index.php, on va changer le type ```text``` de l'input qui sert a récupérer la date de naissance de l'utilisateur en type ```date```.On va ensuite attribuer une value en PHP qui va servir a parametrer le format de la date:

```
  <input type="date" name="birthdate" value="<?php echo date('d-m-Y');?>">
```
### Le traitement

On va créer une nouvelle fonction qu'on appelle « calcul_age() » :
```
function calcul_age (){}
```
Dans cette fonction, la première chose qu'on vérifie, c'est la présence d'une valeur dans la superglobale ```$_POST```. Pour ce faire, on passe en paramètre la fonction ```isset()``` qui prend elle même ```$_POST```+ le name de l'input en paramètre.La fonction isset sert a vérifier si une variable est considérée définie, ceci signifie qu'elle est déclarée et est différente de NULL. Si il n'y a rien dans ```$_POST```, on fait apparaitre un message d'erreur.

```
if(isset($_POST['birthdate'])){

  // On va tapper notre code ici.
  } else {
  echo  "<p> Vous n'avez pas écris de date.</p>"   ;
}
```
Maintenant, on va convertir la valeur de la variable superglobale ```$_POST``` qui est au format chaine de caractèretere en une valeur au format timestamp. Le timestamp (unix) désigne le nombre de secondes écoulées depuis le 1er janvier 1970 à minuit UTC précise.

Pour ce faire,on redefinit le contenu de la varaible $birthdate en utilisant la fonction ```strtotime()``` à laquelle on passe en parametre ```$_POST```:

```
$birthdate=strtotime($_POST['birthdate']);
```
L'objectif, c'est de comparer le jour, le mois et l'année de naissance au jour, au mois et a l'année courante. Pour ce faire, on déclare 3 nouvelles variables:```$day_birthday, $month_birthday, $year_birthday```, auxquelles on va affecter la fonction ```date()``` a laquelle on passe en parametre le format du jour, le format du mois et le format de l'année de type int récupérer dans la variable birthdate qui contient une date au format timestamp:

```
$day_birthday=date('d', $birthdate);
$month_birthday=date('m', $birthdate);
$year_birthday=date('Y', $birthdate);
```
De la même facon, on va declarer 3 variables qui vont contenir la fonction date avec en parametre les options de jours, mois et année:

```
$day_today=date('d');
$month_today=date('m');
$year_today=date('Y');
```
Il nous rest maintenant a faire le traitement. On créer une condition qui va comparer le jour de naissance et le mois de naissance au jour et au mois courant. Si le jpur et le moi de naissance sont respectivement superieur ou egale au jour et au mois courant alors on declare une variable $age qui co tient la soustraction de l'année de naissance a l'année actuelle moins 1.
Sinon la même variable $age contient seulement la soustraction de l'année de naissance à l'année courante:

```
if($day_birthday>$day_today&&$month_birthday>=$month_today){
  $age=($year_today-$year_birthday)-1;
}else {
 $age=($year_today-$year_birthday);
}
```
Enfin, a l'exterieur de la fonction calcul_age(), on appelle cette fonction:

```
calcul_age();
```
## Le code complet:

### Le html

```
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Calcul de l'age </title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <div class="">
      Renseignez votre date de naissance ?
    </div>
    <form class="" action="traitement2.php" method="post">
      <input type="date" name="birthdate" value="<?php echo date('d-m-Y');?>">
      <input type="submit" name="" value="envoyer">
    </form>

  </body>
</html>
```


### Le PHP

```
<?php
 function calcul_age (){
   if(isset($_POST['birthdate'])){
     $birthdate=strtotime($_POST['birthdate']);
     $day_birthday=date('d', $birthdate);
     $month_birthday=date('m', $birthdate);
     $year_birthday=date('Y', $birthdate);

     $day_today=date('d');
     $month_today=date('m');
     $year_today=date('Y');
     // var_dump($day);
     if($day_birthday>$day_today&&$month_birthday>=$month_today){
       $age=($year_today-$year_birthday)-1;
     }else {
      $age=($year_today-$year_birthday);
     }
   }else {
     echo  "<p> Vous n'avez pas écris de date.</p>"   ;
   }
   echo "Vous avez ".$age. " ans.";
 }
calcul_age();
```
