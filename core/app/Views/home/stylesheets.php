<style>
    .custom-navbar {
        max-width: max-content;
        margin: 0 auto;
        margin-bottom: 10px;
        border-radius: 10px;
        /* Background transparan */
        background: rgba(255, 255, 255, 0.3);
        /* Efek blur */
        backdrop-filter: blur(10px);
    }

    .nav-link:hover {
        color: var(--bs-danger) !important;
    }


    /* custom search popup */
    div#panorama.active {
        filter: blur(20px);
        pointer-events: none;
        user-select: none;
    }

    #popupSearch {
        position: fixed;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        visibility: hidden;
        opacity: 0;
        transition: 0.5s;
    }

    #popupSearch.active {
        top: 40%;
        visibility: visible;
        opacity: 1;
        transition: 0.5s;
    }

    .search-box {
        padding: 0;
        font-family: 'Poppins', sans-serif;
        width: 600px;
        background: #fff;
        /* margin: 200px auto 0; */
        border-radius: 5px;

        /* position: absolute; */
        /* padding-top: 40px; */
        /* Adjust this value as needed */
    }

    .row-search {
        display: flex;
        align-items: center;
        padding: 10px 20px;
    }

    input {
        flex: 1;
        height: 50px;
        background: transparent;
        border: 0;
        outline: 0;
        font-size: 18px;
        color: #333;

    }

    button {
        background: transparent;
        border: 0;
        outline: 0;

    }

    button .fa-solid {
        width: 25px;
        color: #555;
        font-size: 22px;
        cursor: pointer;
    }

    ::placeholder {
        color: #555;
    }

    .close-btn {
        width: 30px;
        height: 30px;
        line-height: 0.75;
        background-color: #dc3545;
        /* Sesuaikan warna sesuai kebutuhan */
        border: none;
        cursor: pointer;
    }

    .result-box {
        max-height: 300px;
        overflow-y: scroll;
    }

    .result-box ul {
        border-top: 1px solid #999;
        padding: 15px 10px;
    }

    .result-box ul li {
        list-style: none;
        border-radius: 3px;
        padding: 15px 10px;
        cursor: pointer;
    }

    .result-box ul li:hover {
        background: #e9f3ff;
    }

    .text-border {
        text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }

    #imageHD {
        margin-top: 30px;
        margin-right: 50px;
    }

    /* Media query for mobile devices */
    @media screen and (max-width: 650px) {
        .search-box {
            width: 80vw;
        }

        .pnlm-compass {
            display: block !important;
            top: 10px;
            right: 12px;
            bottom: auto;
        }

        .pnlm-panorama-info {
            display: block !important;
            top: 18px;
            bottom: auto;
        }

        #imageHD {
            margin-top: 60px;
            margin-right: 10px;
        }
    }

    /* custom hotspot */
    .step-hotspot {
        height: 110px;
        width: 110px;
        background-color: yellow;
        background: url(<?= base_url('/assets/img/arrow.gif'); ?>);
        background-size: 110px 110px;
    }

    .room-hotspot {
        height: 80px;
        width: 80px;
        background-color: yellow;
        background: url(<?= base_url('/assets/img/door.gif'); ?>);
        background-size: 80px 80px;
        /* transition: transform 0.3s ease; */
    }

    .info-hotspot {
        height: 70px;
        width: 70px;
        background-color: yellow;
        background: url(<?= base_url('/assets/img/info.gif'); ?>);
        background-size: 70px 70px;
        /* transition: transform 0.3s ease; */
    }

    div.custom-tooltip span {
        visibility: hidden;
        position: absolute;
        border-radius: 3px;
        background-color: #fff;
        color: #000;
        text-align: center;
        max-width: 200px;
        padding: 5px 10px;
        margin-left: -220px;
        cursor: default;
    }

    div.custom-tooltip:hover span {
        visibility: visible;
    }

    div.custom-tooltip:hover span:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-width: 10px;
        border-style: solid;
        border-color: #fff transparent transparent transparent;
        bottom: -20px;
        left: -10px;
        margin: 0 50%;
    }

    #map {
        height: 70vh;
        width: 100%;
    }

    .map-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        /* Ratio 16:9 */
        height: 0;
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>