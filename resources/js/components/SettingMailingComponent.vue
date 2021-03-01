<template>
  <main>
    <div class="email-push-show__tabs">
      <a @click="show = 1" :class="{ active: show === 1 }"
        >Адреса отправителя</a
      >
      <a @click="show = 2" :class="{ active: show === 2 }">Аутентификация</a>
    </div>
    <div class="create-mail" style="margin-bottom: 15px">
      <div class="button_green mr-24">
        <span
          class="green_button_circle desplode-circle"
          style="left: 179px; top: 49px"
        ></span>
        <a @click="showPopup = true" href="#" class="button_green_inner"
          ><img src="http://www.pushgun.ru/images/zavitok.svg" alt="" />
          <p class="button_text_container">Новый адрес отправителя</p></a
        >
      </div>
      <div class="button_green mr-24">
        <span
          class="green_button_circle desplode-circle"
          style="left: 51px; top: 43.125px"
        ></span>
        <a href="#" class="button_green_inner"
          ><img src="http://www.pushgun.ru/images/telephoune.svg" alt="" />
          <p class="button_text_container">Имя отправителя смс
          </p></a
        >
      </div>
    </div>
    <div v-if="show === 1" class="contact-table">
      <div
        style="
          display: flex;
          justify-content: space-between;
          align-items: center;
        "
      >
        <div id="filter" style="margin-bottom: 15px" class="button_green">
          <span
            class="green_button_circle desplode-circle"
            style="left: 102px; top: 31px"
          ></span>
        </div>
        <a class="contact-table__btn">Экспорт</a>
      </div>
      <div class="contact-table__wrapper">
        <div class="contact-table__wrapper head">
          <ul style="grid-template-columns: 1fr 1fr 1fr 0.1fr">
            <li>Email адрес</li>
            <li>Имя</li>
            <li>Состояние</li>
            <li></li>
          </ul>
        </div>
        <div
          v-for="item in items"
          :key="item.id"
          class="contact-table__wrapper"
        >
          <ul
            style="grid-template-columns: 1fr 1fr 1fr 0.1fr"
            class="statuses-color"
          >
            <li>
              <span>Email адрес:</span>
              <p>{{ item.title }}</p>
            </li>
            <li>
              <span>Имя:</span>
              <p>{{ item.name }}</p>
            </li>
            <li class="green-color" :class="{ red: item.statuses === 2 }">
              <span>Состояние:</span>
              <p>{{ item.status }}</p>
            </li>
            <li>
              <!-- <span>Устройство/Браузер:</span> -->
              <p @click="func(item)">...</p>
            </li>
          </ul>
          <div v-if="showModal === item" class="contact-table__modal">
            <div @click="showModal = null" class="contact-table__modal__close">
              x
            </div>
          </div>
        </div>
      </div>
      <div class="contact-table__pagination">
        <span class="active">1</span>
        <span>2</span>
        <span>3</span>
        <img src="../../images/right.svg" />
      </div>
    </div>
    <div v-if="showPopup === true" class="contact-popup">
      <div v-click-outside="closePopup" class="contact-popup__block">
        <div @click="showPopup = false" class="contact-popup__block__head">
          <p>Новая адрес отправителя</p>
          <img src="../../images/business-close.svg" alt="" />
        </div>
        <div class="contact-popup__block__sect">
          <p>Email адрес отправителя:<span>*</span></p>
          <input type="text" placeholder="Значение" />
          <p style="margin-top: 10px">Имя отправителя:<span>*</span></p>
          <input type="text" placeholder="Значение" />
          <p style="margin-top: 10px">Домен отправителя:<span></span></p>
          <input type="text" placeholder="Значение" />
        </div>
        <div class="contact-popup__block__foot">
          <div class="button_green mr-24">
            <span class="green_button_circle"></span>
            <a class="button_green_inner">
              <p class="button_text_container"><img src="" alt="" />Добавить</p>
            </a>
          </div>
          <div style="backgorund: #fafafa" class="button_white">
            <span class="white_button_circle"></span>
            <a
              @click="showPopup = false"
              style="background: rgb(222 222 222 / 1)"
              class="button_white_inner"
            >
              <p class="button_text_container">
                <img class="button-img" src="" alt="" />Отмена
              </p>
            </a>
          </div>
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
    showPopup: false,
    showModal: null,
    show: 1,
    items: [
      {
        id: 1,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Активно",
        statuses: 1,
        country: "Страна",
        device: "Устройство",
      },
      {
        id: 2,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Не активно",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 3,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Не активно",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 4,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Не активно",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 5,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Активно",
        statuses: 1,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 6,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Активно",
        statuses: 1,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 7,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Не активно",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
    ],
  }),
  methods: {
    func(item) {
      this.showModal = item;
    },
    closePopup() {
      this.showPopup = false;
    },
  },
};
</script>