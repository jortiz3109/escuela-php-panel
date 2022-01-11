module.exports = {
    preset: '@vue/cli-plugin-unit-jest',
    testMatch: ['**/__testsjs__/**/*.[jt]s?(x)', '**/?(*.)+(spec|test).[jt]s?(x)'],
    moduleFileExtensions: [
        'js',
        'json',
        'vue'
    ],
    transform: {
        '^.+\\.vue$': 'vue-jest',
        '.+\\.(css|styl|less|sass|scss|svg|png|jpg|ttf|woff|woff2)$': 'jest-transform-stub',
        '^.+\\.jsx?$': 'babel-jest'
    },
    transformIgnorePatterns: [
        '<rootDir>/node_modules/'
    ],
    verbose: true,
    collectCoverage: true,
    coverageDirectory: '<rootDir>/coverage/js'
}
