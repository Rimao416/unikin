<script>
    let myChart3 = document.getElementById("myChart3").getContext('2d');
    let labels_courses='<?php echo trim($mot) ?>'
    labels_courses=labels_courses.slice(0,-1)

    let labels3 = labels_courses.split(',')
    var donnee='<?php echo trim($calcul)?>'
    donnee=donnee.slice(0,-1)

    var b = donnee.split(',').map(function(item) {
        return parseInt(item, 10);
    });

    var donneeA='<?php echo trim($calculA)?>'
    donneeA=donneeA.slice(0,-1)

    var bA = donneeA.split(',').map(function(item) {
        return parseInt(item, 10);
    });

    let chart3 = new Chart(myChart3, {
        type: 'radar',
        data: {
            labels: labels3,
            datasets: [
                {
                    label: 'Presence',
                    fill: true,
                    backgroundColor: "rgba(179, 181, 198, 0.2)",
                    borderColor: "rgba(179, 181, 198, 1)",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(179, 181, 198, 1)",
                    data: b
          },
          {
            label: 'Absence',
            fill: true,
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            borderColor: "rgba(255, 99, 132, 1)",
            pointBorderColor: "#fff",
            pointBackgroundColor: "rgba(255, 99, 132, 1)",
            data:bA
          }
        ]
    },
    options: {
        title: {
            text: "Graphe de presence",
            display: true
        }
    }
});
</script>