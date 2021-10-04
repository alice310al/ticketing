<template>
  <div>
    <section class="content">
      <div class="conteneur">
          <dashboard-card title="Nombres de tickets" class="element-orange" :value="dataDashboard['tickets']" />

          <dashboard-card title="Tickets traités"  class="element-green" :value="dataDashboard['ticketsTraite']"/>

          <dashboard-card title="Tickets annulés" class="element-red" :value="dataDashboard['ticketsCancel']" />

          <dashboard-card title="Utilisateurs" class="element-blue" :value="dataDashboard['user']" />

          <!-- Simple image en attendant de gérer réellement ça par rapport aux tickets -->
          <dashboard-card-img title="Répartitions des types" class="camenbert" img="/camenbert.png" alt="camenbert"/>

          <dashboard-card-img title="Tickets par mois" class="stats" img="/stats.jpg" alt="statistique"/>
      </div>
    </section>
  </div>
</template>

<script>
import DashboardCardImg from '~/components/dashboard-card-img.vue';
import dashboardCard from "~/components/dashboard-card.vue"

export default {
  components: { dashboardCard, DashboardCardImg },
  data () {
    return {
      dataDashboard: {
        "tickets": 0,
        "ticketsTraite": 0,
        "ticketsCancel": 0,
        "user": 0,
      }
    }
  },
  created() {
    this.$root.updateTitle("DASHBOARD");
    this.initDashboard();
  },
  methods: {
    initDashboard() {
      this.$axios.$get("/api/dashboard").then(result => {
        console.log(result);
          this.dataDashboard = result;
      })
    },
  }
}
</script>
