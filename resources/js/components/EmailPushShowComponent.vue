<template>
  <main>
    <div class="email-push-show__tabs">
      <a @click="show = 1" :class="{ active: show === 1 }">Просмотр рассылки</a>
      <a @click="show = 2" :class="{ active: show === 2 }">Список адресатов</a>
      <a @click="show = 3" :class="{ active: show === 3 }"
        >Статистика компании</a
      >
    </div>
    <div v-if="show === 1" class="email-push-show__wrapper tab1">
      <div class="email-push-show__wrapper-item">
        <p>Статус рассылки:</p>
        <span style="color: #3b8378">Отправлено</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>По адресной книге:</p>
        <span style="color: #5ba4d7">Название адресной книги</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Email адрес отправителя:</p>
        <span>admin@admin.com</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Имя отправителя:</p>
        <span>Admin</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Дата отправки:</p>
        <span>04 февраля 2021, 12:00</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Сбор статистики:</p>
        <span>Переход по ссылкам прочтение письма</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Постоянная ссылка на рассылку:</p>
        <span style="color: #5ba4d7"><a>Ссылка</a></span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Тема письма:</p>
        <span>Тема</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Прехедер письма:</p>
        <span>Прехедер</span>
      </div>
      <div class="email-push-show__wrapper-item">
        <p>Тело письма:</p>
        <span></span>
      </div>
      <div style="display: block" class="email-push-show__wrapper-item">
        <div>
          <img src="../../images/shablon.png" alt="" />
          <input
            :class="{ active: headerText != '' }"
            v-model="headerText"
            class="input-header"
            type="text"
          />
          <textarea
            :class="{ active: titleText != '' }"
            class="input-title"
            v-model="titleText"
            type="text"
          />
          <button>Button</button>
          <input
            :class="{ active: footerText != '' }"
            class="input-footer"
            v-model="footerText"
            type="text"
          />
        </div>
      </div>
    </div>
    <div v-if="show === 2" class="contact-table">
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
          <div class="button_green_inner mails__filter_btn">
            <p class="button_text_container">Фильтр</p>
          </div>
        </div>
        <a class="contact-table__btn">Экспорт</a>
      </div>
      <div class="contact-table__wrapper">
        <div class="contact-table__wrapper head">
          <ul>
            <li>Email адрес</li>
            <li>Имя</li>
            <li>Состояние</li>
            <li>Страна</li>
            <li>Устройство/Браузер</li>
          </ul>
        </div>
        <div
          v-for="item in items"
          :key="item.id"
          class="contact-table__wrapper"
        >
          <ul class="statuses-color">
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
              <span>Страна:</span>
              <p>{{ item.country }}</p>
            </li>
            <li>
              <span>Устройство/Браузер:</span>
              <p>{{ item.device }}</p>
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
    <div v-if="show === 3">
      <div class="general__stats tab-item active">
        <div class="general__stats_left">
          <div
            class="general__stats_left-item stats__item"
            style="background: rgb(255, 128, 139)"
          >
            <h3>1</h3>
            <div class="mb-10">
              <p class="medium">100% доставлено</p>
            </div>
          </div>
          <div
            class="general__stats_left-item"
            style="background: rgb(150, 152, 213)"
          >
            <h3>50</h3>
            <p class="medium mb-10">Ошибок</p>
          </div>
          <div
            class="general__stats_left-item"
            style="background: rgb(54, 194, 207)"
          >
            <h3>1</h3>
            <p class="medium mb-10">Отправлено</p>
          </div>
        </div>
        <div class="general__stats_right">
          <div class="general__stats_right-top">
            <h3>Статистика последних рассылок</h3>
            <div class="general__stats_right-buttons">
              <select>
                <option value="week">За неделю</option>
                <option value="month">За месяц</option>
                <option value="year">За год</option>
              </select>
            </div>
          </div>
          <div class="canvas-container">
            <div class="canvas-container">
              <statistic-chart-component></statistic-chart-component>
            </div>
          </div>
        </div>
      </div>
      <div class="charts-inform">
        <div class="charts-inform__item">
          <p>
            Открыто:<span>{{ open }}</span>
          </p>
          <input type="range" :value="500" min="0" max="1500" disabled />
        </div>
        <div class="charts-inform__item">
          <p>
            Переходы:<span>{{ transition }}</span>
          </p>
          <input type="range" :value="50" min="0" max="200" disabled />
        </div>
        <div class="charts-inform__item">
          <p>
            Жалобы на спам:<span>{{ complaint }}</span>
          </p>
          <input type="range" :value="5" min="0" max="25" disabled />
        </div>
        <div class="charts-inform__item">
          <p>
            Отписались:<span>{{ unsab }}</span>
          </p>
          <input type="range" :value="5" min="0" max="25" disabled />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data: () => ({
    show: 1,
    open: 500,
    transition: 50,
    complaint: 5,
    unsab: 5,
    headerText: "",
    titleText: "",
    footerText: "",
    items: [
      {
        id: 1,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправлено",
        statuses: 1,
        country: "Страна",
        device: "Устройство",
      },
      {
        id: 2,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправка запрещена",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 3,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправка запрещена",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 4,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправка запрещена",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 5,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправлено",
        statuses: 1,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 6,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправлено",
        statuses: 1,
        country: "Страна",
        device: "Браузер",
      },
      {
        id: 7,
        title: "admin@admin.com",
        name: "Андрей",
        status: "Отправка запрещена",
        statuses: 2,
        country: "Страна",
        device: "Браузер",
      },
    ],
  }),
  methods: {
    func(value) {
      console.log(value);
    },
  },
};
</script>