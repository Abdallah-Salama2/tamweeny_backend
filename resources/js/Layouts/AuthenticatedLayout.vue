<script setup>
import Navbar from '@/Components/Layout Components/Navbar.vue'
import Drawer from '@/Components/Layout Components/Drawer.vue'


</script>


<template>
  <div class="w-full ">
    <!-- Top Nav Bar-->
    <Navbar />
  </div>
  <div class="flex ">
    <!-- Side Bar-->
    <Drawer style="z-index:1;max-width: 320px;width: 100vw; height: 100vh" />
    <!-- Content-->
    <div class="content">
      <slot>Default</slot>
    </div>
  </div>
</template>

<style>
.content {

    margin-top: 73px;
    margin-right: 315px;
    //border: 2px solid red;
    //min-height: 100vh;
    min-height: calc(100vh - 73px);
    width: calc(100vw - 320px);

}
/*we used calc to get heigh of content area perfect default height = 100 vh but we have nav bar with 73 px so calc gives height with 100vh-73px u can check with border*/
@media only screen and (max-width: 600px){
    /*Big smartphones [426px -> 600px]*/
    .content{
        margin-right: 0;
        //background-color: red;
        width: 100%;

    }
}

.layout {
    background: rgba(35, 35, 35, 80%);
}

body {
    background: rgba(45, 45, 45, 100%) url('/resources/js/img/base desktop.png') no-repeat center center fixed;
    background-size: cover;
}

body::-webkit-scrollbar
{
    display: none;
}

.activeColor {
    color: #61BC84;
}

/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: grey;
    border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background:#61bc84;
}
</style>
