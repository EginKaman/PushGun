<template>
  <div class="nav__menu">
    <ul class="nav__menu_inner">
      <li class="nav__menu_items one">
        <a class="nav__menu_link" href="/account">{{ $t("Все рассылки") }}</a>
      </li>
      <li class="nav__menu_items two">
        <a class="nav__menu_link" href="/account/autoMailing">{{
          $t("Авторассылки")
        }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "HeaderSitesComponent",
};
</script>

<style scoped>
</style>
