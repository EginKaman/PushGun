<template>
  <main>
    <div class="create-push-mail">
      <form>
        <div class="sms-create__wrapp">
          <div class="create-push-mail__block">
            <div class="create-push-mail__block__item">
              <p>SMS от</p>
              <input placeholder="Значение" type="text" />
            </div>
            <div class="create-push-mail__block__item">
              <p>Текст уведомления</p>
              <textarea placeholder="Тектс" v-model="text" name="" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="create-push-mail__block__item">
              <p>Получатели</p>
              <select>
                <option>Ручной ввод</option>
                <option>Не ручной ввод</option>
              </select>
              <textarea
              placeholder="Введите номера телефонов, каждый номер с новой строки. Вы можете добавить не более 500 контактов"
                style="margin-top: 15px"
                name=""
                id=""
                cols="30"
                rows="10"
              ></textarea>
            </div>
            <div class="create-push-mail__block__item radiobox">
              <p>Время отправки:</p>
              <label>
                <input name="send" type="radio" />
                <p>Немедленно</p>
              </label>
              <div class="cal">
                <label>
                  <input name="send" type="radio" />
                  <p style="margin-right: 20px">Начать отправку</p>
                </label>
                <calendar
                  calendarType="range"
                  placeholder="Выберите дату"
                ></calendar>
              </div>
            </div>
            <div class="create-push-mail__block__item checkbox">
              <label>
                <input name="send" type="checkbox" />
                <p>Переотправить рассылку по непрочитанным</p>
              </label>
            </div>
          </div>
          <div class="sms-create__wrapp-img">
            <div>
              <div>
                <img src="../../images/iphone-group.png" alt="" />
                <p>{{text}}</p>
              </div>
            </div>
          </div>
        </div>
        <button>Начать рассылку</button>
      </form>
    </div>
  </main>
</template>
<script>
import Calendar from "./UI/Calendar.vue";

export default {
  components: {
    Calendar,
  },
  data: () => ({
      text: '',
  }),
  methods: {},
};
</script>