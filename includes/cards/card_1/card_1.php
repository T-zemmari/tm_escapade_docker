<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Roboto:wght@300;400;900&display=swap");

    :root {
        --currencyPrefix: "$";
    }


    .contenedorCards {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: flex-start;
        align-content: flex-start;
        min-height: 100vh;
        padding: 20px 0;
        box-sizing: border-box;
        gap: 20px;
    }

    .contenedorCards .card {
        width: 280px;
        transition: ease all 0.3s;
        border: none !important;
    }

    .contenedorCards .card.esFav .wrapper .infoProd .actions .action.aFavs {
        transform: rotateX(360deg) scale(1.2);
    }

    .contenedorCards .card.esFav .wrapper .infoProd .actions .action.aFavs svg path,
    .contenedorCards .card.esFav .wrapper .infoProd .actions .action.aFavs svg circle {
        fill: #fff;
        transition-delay: 0.2s;
    }

    .contenedorCards .card.enCarrito .wrapper .infoProd .actions .action.alCarrito .inCart {
        transform: scale(1);
    }

    .contenedorCards .card.enCarrito .wrapper .infoProd .actions .action.alCarrito .outCart {
        transform: scale(0);
    }

    .contenedorCards .card .wrapper {
        margin: 60px 10px 10px 10px;
        padding-top: 300px;
        box-sizing: border-box;
        position: relative;
        box-shadow: 0 0 20px 10px rgba(29, 29, 29, 0.1);
        transition: ease all 0.3s;
    }

    .contenedorCards .card .wrapper:hover {
        transform: translateY(-10px);
    }

    .contenedorCards .card .wrapper:hover .imgProd {
        height: 350px;
    }

    .contenedorCards .card .wrapper .colorProd {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 200px;
        background-color: #007bff;
    }

    .contenedorCards .card .wrapper .imgProd {
        background-size: contain;
        background-position: center bottom;
        background-repeat: no-repeat;
        position: absolute;
        bottom: calc(100% - 300px);
        width: 100%;
        height: 300px;
        transition: ease all 0.3s;
    }

    .contenedorCards .card .wrapper .infoProd {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
        align-content: center;
        height: 170px;
        padding: 20px;
        box-sizing: border-box;
    }

    .contenedorCards .card .wrapper .infoProd p {
        width: 100%;
        font-size: 14px;
        text-align: center;
    }

    .contenedorCards .card .wrapper .infoProd .nombreProd {
        font-family: "Roboto", sans-serif;
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 600;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
    }

    .contenedorCards .card .wrapper .infoProd .extraInfo {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .contenedorCards .card .wrapper .infoProd .actions {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        align-content: center;
        width: 100%;
        margin-top: auto;
        padding-top: 10px;
    }

    .contenedorCards .card .wrapper .infoProd .actions .preciosGrupo {
        flex-grow: 1;
        position: relative;
    }

    .contenedorCards .card .wrapper .infoProd .actions .preciosGrupo .precio {
        font-family: "Roboto", sans-serif;
        color: #1d1d1d;
        font-size: 25px;
        font-weight: 600;
        text-align: left;
    }

    .contenedorCards .card .wrapper .infoProd .actions .preciosGrupo .precio.precioOferta {
        position: absolute;
        left: 0;
        top: -20px;
        color: red;
        font-size: 15px;
        text-decoration: line-through;
    }

    .contenedorCards .card .wrapper .infoProd .actions .preciosGrupo .precio.precioOferta:before {
        font-size: 12px;
    }

    .contenedorCards .card .wrapper .infoProd .actions .preciosGrupo .precio:before {
        content: var(--currencyPrefix);
        font-size: 20px;
    }

    .contenedorCards .card .wrapper .infoProd .actions .action {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        align-content: center;
        margin-left: 15px;
        width: 35px;
        height: 35px;
        position: relative;
        transition: cubic-bezier(0.68, -0.55, 0.27, 1.55) all 0.3s;
        cursor: pointer;
        color: #1d1d1d;
    }

    .contenedorCards .card .wrapper .infoProd .actions .action svg {
        position: absolute;
        transition: cubic-bezier(0.68, -0.55, 0.27, 1.55) all 0.3s;
    }

    .contenedorCards .card .wrapper .infoProd .actions .action svg path,
    .contenedorCards .card .wrapper .infoProd .actions .action svg circle {
        stroke: currentColor;
        fill: transparent;
        transition: ease all 0.3s;
    }

    .contenedorCards .card .wrapper .infoProd .actions .action.aFavs {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1;
        width: 25px;
        height: 25px;
        color: #fff;
    }

    .contenedorCards .card .wrapper .infoProd .actions .action.alCarrito svg.inCart {
        transform: scale(0);
    }
</style>

