<template>
  <div class="container-sm" style="max-width:900px;">
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/"><img style="max-width:100px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/1200px-International_Pok%C3%A9mon_logo.svg.png" alt=""></a>
        <a href="/favorite"><ion-icon class="navbar-toggler" name="heart-circle-outline" style="color:red;"></ion-icon></a>
      </div>
    </nav>
    <br>
    <router-view>
    </router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
}
</script>
