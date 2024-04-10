<style>
    .container_carousel {
        display: flex;
        width: 90vw;
    }

    .panel_carousel {
        background-size: auto 100%;
        background-position: center;
        background-repeat: no-repeat;
        height: 60vh;
        border-radius: 50px;
        color: #fff;
        text-shadow: 0px 2px 4px #000;
        cursor: pointer;
        flex: 0.5;
        margin: 10px;
        position: relative;
        transition: flex 0.7s ease-in;
    }

    .panel_carousel h3 {
        font-size: 24px;
        position: absolute;
        bottom: 20px;
        left: 20px;
        margin: 0;
        opacity: 0;
    }

    .panel_carousel.active {
        flex: 5;
    }

    .panel_carousel.active h3 {
        opacity: 1;
        transition: opacity 1s ease-in 1s;
    }

    @media(max-width: 480px) {
        .container_carousel {
            width: 100vw;
        }

        .panel_carousel:nth-of-type(4),
        .panel_carousel:nth-of-type(5) {
            display: none;
        }
    }
</style>

<div class="container_carousel">
    <div class="panel_carousel active" style="background-image: 
            url('assets/images/custom_img/m_16.jpg')">
        <!--<h3>Marrakech</h3>-->
    </div>
    <div class="panel_carousel" style="background-image: 
            url('assets/images/custom_img/m_15.jpg')">
        <!--<h3>Marrakech</h3>-->
    </div>
    <div class="panel_carousel" style="background-image: 
            url('assets/images/custom_img/marrak_1.jpg')">
        <!--<h3>Marrakech</h3>-->
    </div>
    <div class="panel_carousel" style="background-image: 
            url('assets/images/custom_img/sahara_1.jpg')">
        <!--<h3>Marrakech</h3>-->
    </div>
    <div class="panel_carousel" style="background-image: 
            url('assets/images/custom_img/m_5.jpg')">
        <!--<h3>Marrakech</h3>-->
    </div>
</div>

<script>
    const panels = document.querySelectorAll('.panel_carousel')

    // loop through the node list
    panels.forEach((panel) => {
        // listen for a click
        panel.addEventListener('click', () => {
            removeActive()
            // if clicked -> add a class of active (so also flex = 5)
            panel.classList.add("active")
        })
    })

    // function to remove active class from elements
    function removeActive() {
        // loop through panels
        panels.forEach(panel => {
            // remove active classes from panel objects
            panel.classList.remove('active')
        })
    }
</script>