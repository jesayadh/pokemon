<template>
  <div class="container-sm" style="max-width:900px;">
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Pokemon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="#">Pokemon</a>
            <a class="nav-link" href="#">My Pokemon</a>
          </div>
        </div>
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
