<template>
  <div class="nav__menu">
    <ul class="nav__menu_inner">
      <li class="nav__menu_items one">
        <a class="nav__menu_link" href="/setting">{{ $t("Настройки сервиса") }}</a>
      </li>
      <li class="nav__menu_items two">
        <a class="nav__menu_link" href="/setting/registration">{{
          $t("Регистрация имени отправителя")
        }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

};
</script>

<style scoped>
</style>
