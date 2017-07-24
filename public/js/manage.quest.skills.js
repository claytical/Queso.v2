    $("#add_skill").click(function() {
      var s_id = $("#additional_skills").val();
      var s_name = $("#additional_skills :selected").text();
      $("#additional_skills option[value="+s_id+"]").remove();
      var skillHtml = '<div class="field"><div class="field"><label class="label">';
          skillHtml += s_name;
          skillHtml += "</label></div><div class='field-body'><div class='field'><p class='control is-expanded'>";
          skillHtml += "<input class='input is-large' type='number' name='skill[]' placeholder='Maximum Points'>";
          skillHtml += "<input type='hidden' name='skill_id[]' class='skills-input' value=" + s_id + ">";
          skillHtml += "</p></div></div></div>";
          $("#new_skills").append(skillHtml);
          if($("#additional_skills option").length == 0) {
             $("#additional_skills_parent").remove();
          }
    });

    $("#add_threshold").click(function() {
      var s_id = $("#additional_thresholds").val();
      var s_name = $("#additional_thresholds :selected").text();
      $("#additional_thresholds option[value="+s_id+"]").remove();
      var skillHtml = '<div class="field"><div class="field"><label class="label">';
          skillHtml += s_name;
          skillHtml += "</label></div><div class='field-body'><div class='field is-grouped'><p class='control is-expanded'>";
          skillHtml += "<input class='input is-large' type='number' name='threshold[]' placeholder='Maximum Points'>";
          skillHtml += "<input type='hidden' name='threshold_id[]' class='thresholds-input' value=0>";

          skillHtml += "<input type='hidden' name='threshold_skill_id[]' class='thresholds-input' value=" + s_id + ">";
          skillHtml += "</p></div></div></div>";
          $("#new_thresholds").append(skillHtml);
          if($("#additional_thresholds option").length == 0) {
             $("#additional_thresholds_parent").remove();
          }
    });
