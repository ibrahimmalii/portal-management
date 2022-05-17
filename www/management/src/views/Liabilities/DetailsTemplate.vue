<template>
  <table class="table table-hover details">
    <colgroup>
      <col width="20%" />
      <col width="35%" />
      <col width="30%" />
      <col width="30%" />
    </colgroup>
    <thead>
      <tr>
        <th scope="col">رقم الدفعة</th>
        <th scope="col">المبلغ المطلوب</th>
        <th scope="col">تاريخ الدفع</th>
        <th scope="col">حالة الدفع</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) of data.dates" :key="index">
        <td scope="row">{{ item.id }}</td>
        <td>{{ item.required_amount }}</td>
        <td>{{ item.date }}</td>
        <td>
          <h6>
            <b-badge v-if="item.is_paid" class="bg-success" pill>{{
              $store.state.paid
            }}</b-badge>
            <b-badge v-else class="bg-danger" pill>{{
              $store.state.unpaid
            }}</b-badge>
          </h6>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {};
</script>

<style scoped>
.details {
  background-color: #ededed;
  margin: 1.25rem 0;
  border: 1px solid black;
}
</style>
