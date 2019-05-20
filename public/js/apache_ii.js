const input_list = [
  {
    name: 'temperature',
    range: {
      include_equal: false,
      initial_value: 1,
      map: {
        1: 2,
        2: 3,
        3: 4,
        4: 5,
      }
    }
  }
]

const getScoreFromRange = function(input, range) {
  return Object.keys(range.map).reduce(function(total, key) {
    if ((range.include_equal && input >= key) || (!range.include_equal && input > key)) {
      return range.map[key]
    }
    return total
  }, range.initial_value)
}

$(function() {
  input_list.forEach(function(item) {
    $("[name='" + item.name + "']").change(function() {
      const score = getScoreFromRange($(this).val(), item.range)
      console.log(score)
    })
  })
});