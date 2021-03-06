const input_lists = {
  'apache_ii_score': [
    {
      name: 'temperature',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 30, value: 4},
          {key: 32, value: 3},
          {key: 34, value: 2},
          {key: 36, value: 1},
          {key: 38.5, value: 0},
          {key: 39, value: 1},
          {key: 41, value: 3},
        ]
      }
    },
    {
      name: 'mean_arterial_pressure',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 50, value: 4},
          {key: 70, value: 2},
          {key: 110, value: 0},
          {key: 130, value: 2},
          {key: 160, value: 3},
        ]
      }
    },
    {
      name: 'heart_rate',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 40, value: 4},
          {key: 55, value: 3},
          {key: 70, value: 2},
          {key: 110, value: 0},
          {key: 140, value: 2},
          {key: 180, value: 3},
        ]
      }
    },
    {
      name: 'respiratory_rate',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 6, value: 4},
          {key: 10, value: 2},
          {key: 12, value: 1},
          {key: 25, value: 0},
          {key: 35, value: 1},
          {key: 50, value: 3},
        ]
      }
    },
    {
      name: 'fio2',
      threshold: {
        value: 50,
        include_equal: false,
      },
      choices: {
        less: 'pao2',
        more: 'aapo2',
      }
    },
    {
      name: 'pao2',
      exclude: true,
      range: {
        include_equal: false,
        initial_value: 0,
        map: [
          {key: 55, value: 4},
          {key: 61, value: 3},
          {key: 71, value: 1},
        ]
      }
    },
    {
      name: 'aapo2',
      exclude: true,
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 200, value: 0},
          {key: 350, value: 2},
          {key: 500, value: 3},
        ]
      }
    },
    {
      name: 'ph_choice',
      choices: {
        ph: 'ph',
        hco3: 'hco3',
      }
    },
    {
      name: 'ph',
      exclude: true,
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 7.15, value: 4},
          {key: 7.25, value: 3},
          {key: 7.33, value: 2},
          {key: 7.5, value: 0},
          {key: 7.6, value: 1},
          {key: 7.7, value: 3},
        ]
      }
    },
    {
      name: 'hco3',
      exclude: true,
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 15, value: 4},
          {key: 18, value: 3},
          {key: 22, value: 2},
          {key: 32, value: 0},
          {key: 41, value: 1},
          {key: 52, value: 3},
        ]
      }
    },
    {
      name: 'serum_na',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 111, value: 4},
          {key: 120, value: 3},
          {key: 130, value: 2},
          {key: 150, value: 0},
          {key: 155, value: 1},
          {key: 160, value: 2},
          {key: 180, value: 3},
        ]
      }
    },
    {
      name: 'serum_k',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 2.5, value: 4},
          {key: 3, value: 2},
          {key: 3.5, value: 1},
          {key: 5.5, value: 0},
          {key: 6, value: 1},
          {key: 7, value: 3},
        ]
      }
    },
    {
      name: 'creatinine',
      choices: [
        {description: '>= 3.5', value: '+4'},
        {description: '> 3.5 in ARF', value: '+8'},
        {description: '2-3.4', value: '+3'},
        {description: '2-3.4 in ARF', value: '+6'},
        {description: '1.5-1.9', value: '+2'},
        {description: '1.5-1.9 in ARF', value: '+4'},
        {description: '0.6-1.4', value: '0'},
        {description: '< 0.6', value: '+2'},
      ]
    },
    {
      name: 'hematocrit',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 20, value: 4},
          {key: 30, value: 2},
          {key: 46, value: 0},
          {key: 50, value: 1},
          {key: 60, value: 2},
        ]
      }
    },
    {
      name: 'wbc',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 1, value: 4},
          {key: 3, value: 2},
          {key: 15, value: 0},
          {key: 20, value: 1},
          {key: 40, value: 2},
        ]
      }
    },
    {
      name: 'age',
      range: {
        include_equal: false,
        initial_value: 6,
        map: [
          {key: 45, value: 0},
          {key: 55, value: 2},
          {key: 65, value: 3},
          {key: 75, value: 5},
        ]
      }
    },
    {
      name: 'glasgow_coma',
      equation: function(value) {
        if (value)
          return 15 - value
        else
          return NaN
      }
    },
    {
      name: 'chronic_health_problem',
      choices: [
        {description: 'None', value: '0'},
        {description: 'Non-Surgical', value: '+5'},
        {description: 'Emergent operation', value: '+5'},
        {description: 'Elective operation', value: '+2'},
      ]
    }
  ],
  'sofa_score': [
    {
      name: 'pao2',
      exclude: true,
    },
    {
      name: 'fio2',
      exclude: true,
    },
    {
      name: 'pao2_fio2_ratio',
      args: ['pao2', 'fio2'],
      preprocess: function() {
        if (arguments.length == 2) {
          const result = arguments[0] / (arguments[1] / 100)
          return Math.round(result * 100) / 100
        } else
          return NaN
      },
      range: {
        include_equal: false,
        initial_value: 0,
        map: [
          {key: 100, value: 4},
          {key: 200, value: 3},
          {key: 300, value: 2},
          {key: 400, value: 1},
        ]
      }
    },
    {
      name: 'platelet',
      range: {
        include_equal: false,
        initial_value: 0,
        map: [
          {key: 20, value: 4},
          {key: 50, value: 3},
          {key: 100, value: 2},
          {key: 150, value: 1},
        ]
      }
    },
    {
      name: 'glasgow_coma',
      range: {
        include_equal: false,
        initial_value: 0,
        map: [
          {key: 6, value: 4},
          {key: 10, value: 3},
          {key: 13, value: 2},
          {key: 15, value: 1},
        ]
      }
    },
    {
      name: 'bilirubin',
      range: {
        include_equal: false,
        initial_value: 4,
        map: [
          {key: 1.2, value: 0},
          {key: 2.0, value: 1},
          {key: 6.0, value: 2},
          {key: 12.0, value: 3},
        ]
      }
    },
    {
      name: 'map_or_vaso',
      choices: [
        {description: 'No hypotension', value: '0'},
        {description: 'MAP <70 mmHg', value: '+1'},
        {description: 'Dopamine ≤5 or dobutamine (any dose)', value: '+2'},
        {description: 'Dopamine >5, epinephrine or norepinephrine ≤0.1', value: '+3'},
        {description: 'Dopamine >15, epinephrine or norepinephrine >0.1', value: '+4'},
      ]
    },
    {
      name: 'creatinine_or_urine',
      choices: [
        {description: '<1.2 (<110)', value: '0'},
        {description: '1.2–1.9 (110-170)', value: '+1'},
        {description: '2.0–3.4 (171-299)', value: '+2'},
        {description: '3.5–4.9 (300-440) or UOP <500 mL/day', value: '+3'},
        {description: '≥5.0 (>440) or UOP <200 mL/day', value: '+4'},
      ]
    },
  ]
}

const post_process = {
  'apache_ii_score': function(score) {
    var x = -3.517 + score * 0.146
    var result = Math.exp(x) / (1 + Math.exp(x))
    $("[name='predicted_mortality_rate']").val((result * 100).toFixed(2) + '%')
  }
}

const getScoreFromRange = function(input, range) {
  if (input == "" || isNaN(input))
    return NaN
  input = Number(input)
  var result = range.initial_value;
  range.map.some(function(item) {
    if ((range.include_equal && input <= item.key) || (!range.include_equal && input < item.key)) {
      result = item.value
      return true
    }
  })
  return result
}

const getChoiceFromThreshold = function(input, threshold) {
  if (input == "")
    return null
  if ((threshold.include_equal && input <= threshold.value)
    || (!threshold.include_equal && input < threshold.value)) return "less"
  else return "more"
}

const recalculateAllScore = function() {
  Object.keys(input_lists).forEach(function(score_name) {
    var total_score = 0;
    var score;

    const input_list = input_lists[score_name]
    input_list.forEach(function(item) {
      if (item.preprocess) {
        const args = [];
        if (item.args) {
          item.args.forEach(function(arg) {
            args.push($("#" + score_name + "_tab [name='" + arg + "']").val())
          })
        }
        $("#" + score_name + "_tab [name='" + item.name + "']").val(item.preprocess.apply(null, args))
      }
      if (item.range) {
        score = getScoreFromRange($("#" + score_name + "_tab [name='" + item.name + "']").val(), item.range)
        $("#" + score_name + "_tab [name='" + item.name + "_score']").val(score)
      } else if (item.equation) {
        score = item.equation($("#" + score_name + "_tab [name='" + item.name + "']").val())
        $("#" + score_name + "_tab [name='" + item.name + "_score']").val(score)
      }
    })

    input_list.forEach(function(item) {
      if (item.exclude) return;

      var score;
      if (item.choices) {
        var choice;

        if (Array.isArray(item.choices)) {
          score = $("#" + score_name + "_tab [name='" + item.name + "']:checked").attr('point')
        } else {
          if (item.threshold) {
            choice = getChoiceFromThreshold($("#" + score_name + "_tab [name='" + item.name + "']").val(), item.threshold)
            $("#" + score_name + "_tab [name='" + item.name + "_score'][value='" + choice + "']").prop('checked', true)
          } else
            choice = $("#" + score_name + "_tab [name='" + item.name + "']:checked").val();

          if (!choice)
            return

          Object.keys(item.choices).forEach(function(key) {
            if (choice == key)
              score = $("#" + score_name + "_tab [name='" + item.choices[key] + "_score']").val()
          })
        }
      } else {
        score = $("#" + score_name + "_tab [name='" + item.name + "_score']").val()
      }

      total_score += Number(score)
    })

    $("#" + score_name + "_tab [name='" + score_name + "']").val(total_score)
    const score_labels = $("#" + score_name + "_tab #" + score_name + "_text label")
    var found = false
    score_labels.each(function() {
      if (total_score < $(this).attr('max-score') && !found) {
        $(this).addClass('active')
        found = true
      } else {
        $(this).removeClass('active')
      }
    })

    if (post_process[score_name]) {
      post_process[score_name](total_score)
    }
  })
}

const displayOption = function() {
  Object.keys(input_lists).forEach(function(score_name) {
    const input_list = input_lists[score_name]
    input_list.forEach(function(item) {
      if (item.choices) {
        var name = item.threshold ? item.name + "_score" : item.name;
        if (!Array.isArray(item.choices)) {
          const choice = $("#" + score_name + "_tab [name='" + name + "']:checked").val();
          Object.keys(item.choices).forEach(function(key) {
            if (choice == key)
              $("#" + score_name + "_tab ." + item.choices[key]).show();
            else
              $("#" + score_name + "_tab ." + item.choices[key]).hide();
          })
        }
        $("#" + score_name + "_tab [name='" + name + "']").parent().removeClass('active');
        $("#" + score_name + "_tab [name='" + name + "']:checked").parent().addClass('active');
      }
    })
  })
  recalculateAllScore();
}

$(function() {
  Object.keys(input_lists).forEach(function(score_name) {
    const input_list = input_lists[score_name]
    input_list.forEach(function(item) {
      $("#" + score_name + "_tab [name='" + item.name + "']").change(function(event) {
        if (event.originalEvent)
          $("[name='" + item.name + "']").val(event.originalEvent.srcElement.value);
      })
      $("#" + score_name + "_tab [name='" + item.name + "']").change(recalculateAllScore)

      if (item.choices) {
        if (Array.isArray(item.choices)) {
          var select = ''
          var value = $("#" + score_name + "_tab [name='" + item.name + "']").val()
          var i = 0;
          item.choices.forEach(function(choice) {
            select += '<label class="btn btn-default form-control">'
            select += '<input type="radio" name="' + item.name + '" value="' + i++ + '" point="' + Number(choice.value) + '">'
            select += '<span style="float:left">' + choice.description + '</span>'
            select += '<span style="float:right">' + choice.value + '</span>'
            select += '</label>'
          })
          $("#" + score_name + "_tab [name='" + item.name + "']").parent().html(select)
          $("#" + score_name + "_tab [name='" + item.name + "'][value='" + value + "']").prop('checked', true)
        }

        $("#" + score_name + "_tab [name='" + item.name + "']").change(function() {
          setTimeout(displayOption)
        })

        if (item.threshold) {
          $("#" + score_name + "_tab [name='" + item.name + "_score']").parent().click(function() {
            return false
          })
        }
      }
    })
  })
  recalculateAllScore()
  displayOption()
})