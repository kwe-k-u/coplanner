### Form Functions
##### Form Validation Functions
- validateFormInputs(...inputData{type, value, message_target, message}): boolean
    - The purpose of this function is to validate the input fields of a form and display the given `message` when input validation fails for given `inputData` objects
    - ***type***: one of `email, password` to signify the type of input being validated
    - ***value***: the value of the input field
    - ***message_target***: the `data-eg-target` attribute of the input element <br>
    NB: The corresponding `input` element must have a `data-eg-target`. This attribute is needed in the crated of the `p` element that holds the error message when the function is first run. The `data-eg-target` becomes the `id` of the newly created `p` element. The `data-eg-target` is necessary in toggling the display of the error message during validation.
    - ***message***: the error message to display in the event that the input fails the validation checks