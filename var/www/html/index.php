<!DOCTYPE html>
<html lang="en">
<head>
    <title>World of Pets!!</title>
    <?php
    // Include head.inc.php for the <head> section
    include "inc/head.inc.php";
    ?>
</head>
<body>

<?php
// Include header.inc.php for the header section
include "inc/header.inc.php";
?>

<?php
// Include nav.inc.php for the navigation menu
include "inc/nav.inc.php";
?>

<main class="container">
    <section id="dogs">
        <h2 class="sectionheader">All About Dogs!</h2>
        <div class="row">
            <article class="col-sm">
                <h3>Poodles</h3>
                <figure>
                    <img class="img-thumbnail" src="images/poodle_small.jpg"
                         alt="Poodle" title="View larger image..."/>
                    <figcaption>This is to test!</figcaption>
                </figure>
                <p>
                    Poodles are a group of formal dog breeds, the Standard
                    Poodle, Miniature Poodle and Toy Poodle. The height of the poodle is typically between 18 and 24 inches,
                    although being over 15 inches specifically sets the Standard Poodle apart from Miniature Poodle and Toy Poodle.
                </p>
            </article>

            <article class="col-sm">
                <h3>Chihuahua</h3>
                <figure>
                    <img class="img-thumbnail" src="images/chihuahua_small.jpg"
                         alt="Chihuahua" title="View larger image..."/>

                    <figcaption>Chihuahua</figcaption>
                </figure>
                <p>
                    The Chihuahua is the smallest breed of dog, and is named
                    after the Mexican state of Chihuahua.There are two variables of Chihuahua - The Smooth Coat (smooth-haired)
                    and the Long Coat(long-haried). Both the Smooth and Long Coat have their special attractions and are equally
                    easy keep clean and well-groomed.
                </p>
            </article>
        </div>
    </section>

    <section id="cats">
        <h2 class="sectionheader">All About Cats!</h2>
        <div class="row">
            <article class="col-sm">
                <h3>Tabby</h3>
                <figure>
                    <img class="img-thumbnail" src="images/tabby_small.jpg"
                         alt="Tabby" title="View larger image..."/>
                    <figcaption>Tabby Cat</figcaption>
                </figure>
                <p>
                    “A tabby is any domestic cat (Felis catus) with a distinctive ‘M’ shaped marking on its forehead,
                    stripes by its eyes and across its cheeks, along its back, and around its legs and tail, and (differing by tabby type),
                    characteristic striped, dotted, lined, flecked, banded or swirled patterns on the body-neck, shoulders, sides,
                    flanks, chest and abdomen. ‘Tabby’ is not a breed of cat but a coat type seen in almost all genetic lines of domestic cats,
                    regardless of breed or pedigree status.
                </p>
            </article>

            <article class="col-sm">
                <h3>Calico</h3>
                <figure>
                    <img class="img-thumbnail" src="images/calico_small.jpg"
                         alt="Calico" title="View larger image..."/>
                    <figcaption>Calico Cat</figcaption>
                </figure>
                <p>
                    A calico cat is a domestic cat of any breed with a tri-color coat. The calico cat on its forehead,
                    stripes by its eyes and across its cheeks, along its back, and around its legs and tail, and
                    (differing by tabby type), characteristic striped, dotted, lined, flecked, banded or
                    swirled patterns on the body-neck, shoulders, sides, flanks, chest and abdomen.

                    The most commonly thought of as being typically 25% to 75% white with large orange and black patches
                    (or sometimes cream and grey patches); however, the calico cat can have any three colors in its pattern.
                    They are almost exclusively female except under rare genetic conditions. Calico is not to be confused with a
                    tortoiseshell, which has a mostly mottled coat of black/orange or grey/cream with relatively few to no
                    white markings.
                </p>
            </article>
        </div>
    </section>
</main>

<?php
// Include footer.inc.php for the footer section
include "inc/footer.inc.php";
?>

</body>
</html>
