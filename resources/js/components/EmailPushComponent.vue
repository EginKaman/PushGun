<template>
  <main>
    <div v-for="item in 3" :key="item.id" class="general__sites">
      <div class="general__sites_item mails__sites">
        <div class="flex">
          <a href="">
            <img class="general__sites_item-img" src="/../../images/site.svg" />
          </a>
          <div class="general__sites_info mails__sites_info">
            <a href="/email/show">Название рассылки</a>
            <p>
              <img src="/../../images/mark.svg" alt="" />
              Отправлено: 15 мая 2020 г, 14:00
            </p>
            <p>
              <img src="/../../images/siteDark.svg" alt="" />
              База(7)
            </p>
          </div>
        </div>
        <div class="mails__sites_stats">
          <div class="mails__sites_stats-item">
            <h3>2</h3>
            <p>отправлено</p>
          </div>
          <div class="mails__sites_stats-item">
            <h3>2</h3>
            <p>доставлено</p>
          </div>
          <div class="mails__sites_stats-item">
            <h3>2</h3>
            <p>переходов</p>
          </div>
        </div>
        <div @click="openPopup(item)" class="mails__sites_stats-item-menus">
          <span>...</span>
        </div>
        <div
          v-click-outside="closePopup"
          v-if="show === item"
          class="general__sites__item-modal"
        >
          <a
            ><img src="/../../images/stat1.svg" alt="" />
            <p>Сатистика</p></a
          >
          <a
            ><img src="/../../images/stat2.svg" alt="" />
            <p>Обзор рассылки</p></a
          >
          <a
            ><img src="/../../images/stat3.svg" alt="" />
            <p>Копировать в новую</p></a
          >
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import vClickOutside from "v-click-outside";
export default {
  directives: {
    clickOutside: vClickOutside.directive,
  },
  data: () => ({
    show: null,
  }),
  methods: {
    openPopup(item) {
      this.show = item;
    },
    closePopup() {
      this.show = false;
    },
  },
};
</script>