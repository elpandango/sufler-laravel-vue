<template>
    <div class="wrapper">
        <div class="sliding-text"
             :style=style
             :class="{ paused }"
             @click="paused = !paused">
            {{text}}
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                list: [],
                paused: false,
                style: 'animation: text-slide ' + this.speed + 's'
            }
        },
        props: ['text', 'speed']
    }
</script>

<style>
    body {
        padding: 0;
        margin: 0;
        font-family: 'Fira Sans Condensed', sans-serif;
    }

    .sliding-text {

        padding: 100px 15px 0;
        position: relative;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
        background-color: #e6e6ee;
        word-break: break-word;
        -webkit-transform: rotate3d(0, 1, 0, 180deg);
        -moz-transform: rotate3d(0, 1, 0, 180deg);
        -ms-transform: rotate3d(0, 1, 0, 180deg);
        -o-transform: rotate3d(0, 1, 0, 180deg);
        transform: rotate3d(0, 1, 0, 180deg);
    }

    .sliding-text.paused {
        -webkit-animation-play-state: paused !important;
        animation-play-state: paused !important;
    }

    .wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .overlay {
        background-color: rgba(0, 0, 0, .6);
        position: fixed;
        z-index: 5;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
    }

    .overlay.opened {
        display: block;
    }

    body:not(.has-navigation) .overlay.opened .play-btn-big {
        display: block;
    }

    .navigation {
        position: fixed;
        z-index: 10;
        top: 0;
        right: -100%;
        width: 65%;
        height: 100vh;
        background-color: #ebebeb;
        -webkit-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
        /*transform: rotate3d(0, 1, 0, 180deg);*/
        /*-webkit-transform: rotate3d(0, 1, 0, 180deg);*/
        /*-o-transform: rotate3d(0, 1, 0, 180deg);*/
        padding: 20px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .navigation.opened {
        right: 0;
    }

    .navigation-wrap {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        height: 100%;
    }

    .play-btn-big {
        display: none;
        position: fixed;
        z-index: 15;
        top: calc(50% - 50px);
        left: calc(50% - 50px);
        width: 100px;
        height: 100px;
        background-image: url('data:image/png;base64,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');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;

        -webkit-animation: playZoom 2s infinite;
        animation: playZoom 2s infinite;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
    }

    .navigation .play-wrap {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }

    .navigation .play-wrap .text {
        font-size: 24px;
        margin-left: 20px;
    }

    .navigation .play-btn {
        width: 60px;
        height: 60px;
        background-image: url('data:image/png;base64,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');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;

        -webkit-animation: playZoom 2s infinite;
        animation: playZoom 2s infinite;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
    }

    .navigation .nav-menu {
        padding: 0;
        margin: 0;
        list-style: none;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .navigation .nav-menu li {
        position: relative;
        padding: 0;
        color: #D29D25;
        font-variant: small-caps;
        font-weight: bold;
        cursor: pointer;
    }

    .nav-menu li:before {
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #4F5151;
        content: "";
        left: 0;
        -webkit-transition: .3s ease-in-out;
        -o-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
        top: 27px;
    }

    .nav-menu li:after {
        position: absolute;
        border-left: 1px dotted #4F5151;
        width: 1px;
        bottom: -12px;
        content: "";
        left: 3px;
        top: 48px;
    }

    .nav-menu li:hover:before {
        -webkit-box-shadow: 0 0 0 10px rgba(0, 0, 0, .2);
        box-shadow: 0 0 0 10px rgba(0, 0, 0, .2)
    }

    .nav-menu li:last-child:after {
        content: none;
    }

    .nav-menu li a {
        font-size: 24px;
        text-decoration: none;
        color: #000000;
        display: block;
        padding: 15px 0 15px 40px;
    }

    @keyframes playZoom {
        0% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        50% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
        }
        100% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @-webkit-keyframes playZoom {
        0% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        50% {
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
        }
        100% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @-webkit-keyframes text-slide {
        from {
            -webkit-transform: rotate3d(0, 1, 0, 180deg) translateY(0);
            transform: rotate3d(0, 1, 0, 180deg) translateY(0);
        }
        to {
            -webkit-transform: rotate3d(0, 1, 0, 180deg) translateY(-100%);
            transform: rotate3d(0, 1, 0, 180deg) translateY(-100%);
        }
    }

    @keyframes text-slide {
        from {
            -webkit-transform: rotate3d(0, 1, 0, 180deg) translateY(0);
            transform: rotate3d(0, 1, 0, 180deg) translateY(0);
        }
        to {
            -webkit-transform: rotate3d(0, 1, 0, 180deg) translateY(-100%);
            transform: rotate3d(0, 1, 0, 180deg) translateY(-100%);
        }
    }

    .sliding-text {
        /*Настройки*/
        font-size: 70px;
        /*-webkit-animation: text-slide 450s;*/
        /*animation: text-slide 450s;*/
    }
</style>